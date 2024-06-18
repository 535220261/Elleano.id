<?php
session_start();
include 'connection.php';

// Tangkap ID produk dari URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mengambil data produk berdasarkan ID
$query = "SELECT * FROM products WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
$stmt->execute();

// Jika produk ditemukan
if ($stmt->rowCount() > 0) {
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Jika produk tidak ditemukan, alihkan ke halaman lain atau tampilkan pesan error
    die("Produk tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $product['product_name']; ?> - Elleano.id</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/elleano.png">

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="styles.css" rel="stylesheet">

    <!-- Custom CSS for Show More/Less -->
    <style>
        .description-short {
            display: inline;
        }
        .description-full {
            display: none;
        }
    </style>
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
            <form class="d-flex me-3">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </form>
            <div class="d-flex">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <div class="d-flex align-items-center">
                        <span class="me-2">Welcome, <?php echo $_SESSION['user_name']; ?></span>
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

    <!-- Product section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="images/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>">
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder"><?php echo $product['product_name']; ?></h1>
                    <p class="display-5 fw-bolder">
                        <?php if (!empty($product['old_price'])): ?>
                            <span class="text-decoration-line-through"><?php echo $product['old_price']; ?></span>
                        <?php endif; ?>
                        <span>Rp <?php echo $product['price']; ?></span>
                    </p>
                    <p class="lead">
                        <span class="description-short"><?php echo substr($product['description'], 0, 100); ?>...</span>
                        <span class="description-full"><?php echo $product['description']; ?></span>
                        <button class="btn btn-link p-0" id="showMoreBtn">Lihat Selengkapnya</button>
                    </p>
                    <div class="d-flex">
                        <input id="inputQuantity" class="form-control text-center me-3" type="num" value="1" style="max-width: 3rem">
                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related items section -->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <!-- Here you can add code to display related products if needed -->
            </div>
        </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript for Show More/Less -->
    <script>
        document.getElementById('showMoreBtn').addEventListener('click', function() {
            var shortDesc = document.querySelector('.description-short');
            var fullDesc = document.querySelector('.description-full');
            if (fullDesc.style.display === 'none') {
                fullDesc.style.display = 'inline';
                shortDesc.style.display = 'none';
                this.innerText = 'Lihat Lebih Sedikit';
            } else {
                fullDesc.style.display = 'none';
                shortDesc.style.display = 'inline';
                this.innerText = 'Lihat Selengkapnya';
            }
        });
    </script>
</body>
</html>
