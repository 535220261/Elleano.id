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

@include('layouts.navbar')

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

@include('layouts.footer')

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS -->
    <script src="js/scripts.js"></script>
</body>
</html>