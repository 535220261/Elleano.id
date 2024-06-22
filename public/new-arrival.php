<?php
session_start();

// Sertakan file koneksi ke database
include 'connection.php';

// Query untuk mengambil data produk dari tabel
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Elleano New Arrival</title>

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

        <!-- Header -->
        <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">new arrival</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
            </div>
        </div>
    </header>

<!-- Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-2 row-cols-lg-4 justify-content-center">
            <?php foreach ($products as $product): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <?php if (!empty($product['badge'])): ?>
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem;">
                                <?php echo $product['badge']; ?>
                            </div>
                        <?php endif; ?>
                        <a href="product.php?id=<?php echo $product['id']; ?>">
                            <img class="card-img-top img-fluid" src="images/<?php echo $product['product_image']; ?>" alt="...">
                        </a>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?php echo $product['product_name']; ?></h5>
                                <?php if (!empty($product['rating'])): ?>
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <?php for ($i = 0; $i < $product['rating']; $i++): ?>
                                            <div class="bi-star-fill"></div>
                                        <?php endfor; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($product['old_price'])): ?>
                                    <span class="text-muted text-decoration-line-through">Rp <?php echo $product['old_price']; ?></span>
                                <?php endif; ?>
                                <span>Rp <?php echo $product['price']; ?></span>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="product.php?id=<?php echo $product['id']; ?>">View options</a>
                                <a class="btn btn-outline-dark mt-auto ms-2" href="#" onclick="addToCart(<?php echo $product['id']; ?>)">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Tombol "Show More" -->
        <div class="text-center mt-4">
            <a href="all-product.php" class="btn btn-primary">Show More</a>
        </div>
    </div>
</section>

<script>
function addToCart(productId) {
    <?php if (isset($_SESSION['user_id'])): ?>
        // Jika user sudah login
        window.location.href = 'cart.php?id=' + productId;
    <?php else: ?>
        // Jika user belum login
        alert('Anda harus login terlebih dahulu!');
        window.location.href = 'login.php';
    <?php endif; ?>
}
</script>

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