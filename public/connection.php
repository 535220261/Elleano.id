<?php
$host = 'localhost';
$dbname = 'products';
$user = 'postgres';
$password = 'michang47';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Periksa apakah semua data POST tersedia
        $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $price = isset($_POST['price']) ? $_POST['price'] : null;

        if ($product_name && $description && $price) {
            // SQL statement untuk INSERT data ke tabel products
            $sql = "INSERT INTO products (product_name, description, price) 
                    VALUES (:product_name, :description, :price)";
            
            // Prepare statement
            $stmt = $pdo->prepare($sql);

            // Bind parameter
            $stmt->bindParam(':product_name', $product_name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);

            // Eksekusi statement
            $stmt->execute();

            echo "Data produk berhasil ditambahkan.";
        } else {
            echo "<script>
                    alert('Silakan lengkapi semua data produk.');
                    window.location.href = 'admin.php';
                  </script>";
            exit; // Hentikan eksekusi skrip PHP setelah mengalihkan
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>