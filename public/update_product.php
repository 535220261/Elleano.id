<?php
include 'connection.php';

// Ambil ID produk yang akan diupdate dari parameter URL
$id = isset($_GET['id']) ? $_GET['id'] : die('ID produk tidak ditemukan.');

// Query untuk mengambil data produk berdasarkan ID
$sql = "SELECT * FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika produk tidak ditemukan
if (!$product) {
    die('Produk tidak ditemukan.');
}

// Proses update produk
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $is_new = isset($_POST['is_new']) ? 1 : 0;
    $is_popular = isset($_POST['is_popular']) ? 1 : 0;

    // Proses upload gambar baru
    if (!empty($_FILES['product_image']['name'])) {
        $targetDir = 'images/';
        $fileName = basename($_FILES['product_image']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Izinkan jenis file tertentu
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Hapus gambar lama jika ada
            if (file_exists($targetDir . $product['product_image']) && !empty($product['product_image'])) {
                unlink($targetDir . $product['product_image']);
            }
            // Pindahkan file ke direktori uploads
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFilePath)) {
                $product_image = $fileName; // Simpan nama file gambar baru
            } else {
                echo "Gagal mengunggah file.";
                exit;
            }
        } else {
            echo "Jenis file tidak didukung.";
            exit;
        }
    } else {
        // Jika tidak ada file yang diunggah, gunakan gambar yang sudah ada
        $product_image = $product['product_image'];
    }

    // Query untuk melakukan update produk
    $updateSql = "UPDATE products SET 
                  product_name = :product_name, 
                  description = :description, 
                  price = :price, 
                  is_new = :is_new, 
                  is_popular = :is_popular,
                  product_image = :product_image 
                  WHERE id = :id";

    $stmt = $pdo->prepare($updateSql);

    // Bind parameter ke statement SQL
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':is_new', $is_new);
    $stmt->bindParam(':is_popular', $is_popular);
    $stmt->bindParam(':product_image', $product_image);
    $stmt->bindParam(':id', $id);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "Data produk berhasil diupdate.";
    } else {
        echo "Gagal mengupdate data produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk</title>
</head>
<body>
    <h1>Update Produk</h1>

    <form action="update_product.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <?php if ($product['product_image']): ?>
            <img src="images/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>" width="100"><br>
        <?php endif; ?>
        <input type="file" name="product_image"><br>
        <input type="text" name="product_name" placeholder="Nama Produk" value="<?php echo $product['product_name']; ?>"><br>
        <textarea name="description" placeholder="Deskripsi Produk"><?php echo $product['description']; ?></textarea><br>
        <input type="text" name="price" placeholder="Harga" value="<?php echo $product['price']; ?>"><br>
        <label><input type="checkbox" name="is_new" value="1" <?php echo $product['is_new'] ? 'checked' : ''; ?>> Produk Baru</label><br>
        <label><input type="checkbox" name="is_popular" value="1" <?php echo $product['is_popular'] ? 'checked' : ''; ?>> Produk Populer</label><br>
        <label for="product_image">Gambar Produk:</label><br>
        
        <button type="submit">Simpan Perubahan</button>
    </form>

</body>
</html>
