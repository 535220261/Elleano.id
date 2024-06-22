
<?php
session_start();
include 'connection.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Ambil informasi pengguna dari database
$user_id = $_SESSION['user_id'];

try {
    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // Jika pengguna ditemukan
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // Jika pengguna tidak ditemukan, alihkan ke halaman login
        header('Location: login.php');
        exit;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

// Proses pembaruan informasi pengguna
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password']; // Jika kata sandi tidak diisi, gunakan kata sandi yang lama

    try {
        $update_query = "UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->bindParam(':username', $username);
        $update_stmt->bindParam(':password', $password);
        $update_stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $update_stmt->execute();

        // Perbarui nama pengguna di sesi
        $_SESSION['user_name'] = $username;

        echo "<script>alert('Informasi akun berhasil diperbarui!');</script>";
        header('Refresh: 0');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="images/elleano.png">

        <!-- Bootstrap icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Core theme CSS (includes Bootstrap) -->
        <link href="styles.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php"><img src="images/elleano.png" alt="Logo" style="height: 100px; width: auto;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="all-product.php">All Products</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="popular-items.php">Popular Items</a></li>
                        <li><a class="dropdown-item" href="new-arrival.php">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex me-3" action="cart.php" method="get">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">
                        <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                    </span>
                </button>
            </form>
            <div class="d-flex">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <div class="d-flex align-items-center">
                    <a href="account.php" class="me-2">Welcome, <?php echo $_SESSION['user_name']; ?></a>
                    <a href="logout.php" class="btn btn-outline-dark">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="d-flex align-items-center">
                        <img src="images/avatar.png" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Account Settings</h2>
        <form method="post" action="account.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password (leave blank to keep current password):</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>