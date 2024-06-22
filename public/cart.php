<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;

    // Pastikan $productId valid
    if (is_numeric($productId) && $productId > 0) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = $quantity;
        } else {
            $_SESSION['cart'][$productId] += $quantity;
        }

        header('Location: cart.php');
        exit;
    }
}

if (isset($_POST['update'])) {
    $quantities = $_POST['quantities'];

    foreach ($quantities as $productId => $quantity) {
        if (is_numeric($quantity) && $quantity > 0) {
            $_SESSION['cart'][$productId] = $quantity;
        } else {
            unset($_SESSION['cart'][$productId]);
        }
    }
    header('Location: cart.php');
    exit;
}

if (isset($_POST['delete'])) {
    $productId = $_POST['product_id'];
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
    header('Location: cart.php');
    exit;
}

// Koneksi ke database
try {
    $pdo = new PDO("pgsql:host=localhost;dbname=products", "postgres", "michang47");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

// Ambil data produk dari keranjang
$cartItems = [];
$totalPrice = 0;

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    $productIds = array_keys($_SESSION['cart']);
    $placeholders = str_repeat('?,', count($productIds) - 1) . '?';
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($productIds);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($cartItems as &$item) {
        $item['quantity'] = $_SESSION['cart'][$item['id']];
        $item['total_price'] = $item['price'] * $item['quantity'];
        $totalPrice += $item['total_price'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Elleanowears</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/elleano.png">

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="styles.css" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
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

<div class="container mt-5">
    <h2>Shopping Cart</h2>
    <form method="post" action="cart.php">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cartItems)): ?>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td>
                                <img src="images/<?php echo htmlspecialchars($item['product_image']); ?>" alt="Product Image" style="width: 100px; height: auto;">
                            </td>
                            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                            <td>Rp <?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <input type="number" name="quantities[<?php echo $item['id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1">
                            </td>
                            <td>Rp <?php echo number_format($item['total_price'], 2); ?></td>
                            <td>
                                <button type="submit" name="delete" value="delete" class="btn btn-danger btn-sm">Delete</button>
                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total</strong></td>
                        <td><strong>Rp <?php echo number_format($totalPrice, 2); ?></strong></td>
                        <td></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Your cart is empty.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="text-right">
            <a href="index.php" class="btn btn-primary">Continue Shopping</a>
            <a href="checkout.php" class="btn btn-success">Checkout</a>
            <button type="submit" name="update" class="btn btn-secondary">Update Cart</button>
        </div>
    </form>
</div>

<section class="footer flex">
    <div class="footer-logo">
        <img src="images/elleano.png" alt="Logo" style="height: 200px; width: auto;">
        <p class="fs-montserrat fs-200">
            Elleano.id is a fashion brand that prioritizes comfort and fit for petite women with a focus on creating clothes that are both snug and comfortable. Elleano.id aspire to become the ultimate fashion destination for petite women, providing a diverse and high-quality collection to enhance their confidence and lifestyle.
        </p>
    </div>

    <div class="social-icons">
        <div class="social-media">
            <h3>Our Social Media</h3>
            <a href="https://www.tiktok.com/@elleano.id"><img src="images/tiktok.png" alt="Logo" style="height: 60px; width: auto;"></a>
            <a href="https://www.instagram.com/elleano.id?igsh=MXByZXFuYjM5MWd4cQ=="><img src="images/instagram.png" alt="Logo" style="height: 60px; width: auto;"></a>
        </div>

        <div class="footer-menu">
            <h3 class="fs-poppins fs-200 bold-800">Official Store</h3>
            <ul>
                <li>
                    <a href="https://shopee.co.id/elleano.id"><img src="images/shopee.png" alt="Logo" style="height: 40px; width: auto;"></a>
                </li>
                <li>
                    <a href="https://www.tokopedia.com/elleanowears"><img src="images/tokopedia.png" alt="Logo" style="height: 40px; width: auto;"></a>
                </li>
                <li>
                    <a href="https://www.tiktok.com/@elleano.id"><img src="images/tiktokshop.png" alt="Logo" style="height: 40px; width: auto;"></a>
                </li>
                <li>
                    <a href="https://www.lazada.co.id/shop/elleano-id"><img src="images/lazada.png" alt="Logo" style="height: 40px; width: auto;"></a>
                </li>
            </ul>
            <h3 class="fs-poppins fs-200 bold-800">Shipping Options</h3>
            <ul>
                <li>
                    <img src="images/JNE.png" alt="Logo" style="height: 40px; width: auto;">
                </li>
                <li>
                    <img src="images/J&T.png" alt="Logo" style="height: 40px; width: auto;">
                </li>
                <li>
                    <img src="images/sicepat.png" alt="Logo" style="height: 40px; width: auto;">
                </li>
                <li>
                    <img src="images/spx.png" alt="Logo" style="height: 40px; width: auto;">
                </li>
            </ul>
        </div>
    </div>

    <div class="contact">
        <h3 class="fs-poppins fs-200 bold-800">Contact Us</h3>
        <p class="fs-montserrat">
            michael.535220261@stu.untar.ac.id <br>
            firzi.535220260@stu.untar.ac.id <br>
            rafael.535220086@stu.untar.ac.id <br>
            +6285217788878 <br>
            Universitas Tarumanagara
        </p>
    </div>

    <form action="/" method="POST" class="emails">
        <h3 class="fs-poppins fs-200 bold-800">Subscribe To Our Email</h3>
        <p class="updates fs-poppins fs-300 bold-800">
            For Latest News & Updates
        </p>
        <div class="inputField flex bg-gray">
            <input type="email" name="email" placeholder="Enter Your Email" class="fs-montserrat bg-gray"/>
        </div>
        <button class="bg-black text-white fs-poppins fs-50">Subscribe</button>
    </form>
</section>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Elleano.id 2024</p>
    </div>
</footer>


    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS -->
    <script src="js/scripts.js"></script>
</body>
</html>
