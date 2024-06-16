<?php
$host = 'localhost';
$dbname = 'products';
$user = 'postgres';
$password = 'michang47';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ambil data dari form
    $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $price = isset($_POST['price']) ? $_POST['price'] : null;
    $is_new = isset($_POST['is_new']) ? 1 : 0;
    $is_popular = isset($_POST['is_popular']) ? 1 : 0;

    if (!$product_name || !$description || !$price) {
        throw new Exception("Silakan lengkapi semua data produk.");
    }

    // Proses upload gambar
    $uploadedFiles = [];
    $uploadError = false;

    foreach ($_FILES['product_image']['tmp_name'] as $key => $tmp_name) {
        $fileName = basename($_FILES['product_image']['name'][$key]);
        $targetFilePath = 'images/' . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($tmp_name, $targetFilePath)) {
                $uploadedFiles[] = $fileName; // Simpan nama file yang berhasil diunggah
            } else {
                $uploadError = true;
                break;
            }
        } else {
            $uploadError = true;
            break;
        }
    }

    if ($uploadError) {
        echo "Gagal mengunggah file.";
    } else {
        // SQL statement untuk INSERT data ke tabel products
        $sql = "INSERT INTO products (product_name, description, price, is_new, is_popular, product_image) 
                VALUES (:product_name, :description, :price, :is_new, :is_popular, :product_image)";

        // Prepare statement
        $stmt = $pdo->prepare($sql);

        // Bind parameter produk ke pernyataan INSERT
        foreach ($uploadedFiles as $fileName) {
            $stmt->bindParam(':product_name', $product_name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':is_new', $is_new);
            $stmt->bindParam(':is_popular', $is_popular);
            $stmt->bindParam(':product_image', $fileName); // Gunakan nama file yang diunggah

            // Eksekusi statement
            $stmt->execute();
        }

        echo "Data produk berhasil ditambahkan.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
