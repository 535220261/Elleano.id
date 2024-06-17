<?php
include 'connection.php';

// Query untuk mengambil data produk
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);

// Mendapatkan hasil query sebagai array asosiatif
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/admin.png">

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <link href="styles.css" rel="stylesheet">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php"><img src = "images/elleano.png" alt="Logo" style="height: 100px; width: auto;" ></a>
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
                    <a href="login.php" class="d-flex align-items-center">
                        <img src="images/avatar.png" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                    </a>
                </div>
            </div>
        </div>
    </nav>

<form action="process_create.php" method="post" enctype="multipart/form-data">
    <label for="photos">Unggah Foto (Maksimal 8):</label><br>
    <input type="file" name="product_image[]" multiple><br> <!-- Perhatikan penggunaan name="product_image[]" -->
    <input type="text" name="product_name" placeholder="Nama Produk"><br>
    <textarea name="description" placeholder="Deskripsi Produk"></textarea><br>
    <input type="text" name="price" placeholder="Harga"><br>
    <label><input type="checkbox" name="is_new" value="1"> Produk Baru</label><br>
    <label><input type="checkbox" name="is_popular" value="1"> Produk Populer</label><br>
    <button type="submit">Simpan</button>
</form>


    <hr>

    <h1>Daftar Produk</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Produk Baru</th>
            <th>Produk Populer</th>
            <th>Gambar</th>
            <th>Action</th> <!-- Kolom untuk action -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['product_name']; ?></td>
            <td><?php echo $product['description']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['is_new'] ? 'Ya' : 'Tidak'; ?></td>
            <td><?php echo $product['is_popular'] ? 'Ya' : 'Tidak'; ?></td>
            <td>
                <?php if ($product['product_image']): ?>
                    <img src="images/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>" width="100">
                <?php else: ?>
                    No Image
                <?php endif; ?>
            </td>
            <td>
                <a href="update_product.php?id=<?php echo $product['id']; ?>">Update</a> |
                <a href="delete_product.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus produk ini?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


</body>
</html>
