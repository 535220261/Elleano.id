<?php
include 'connection.php';

// Ambil ID produk yang akan dihapus dari parameter URL
$id = isset($_GET['id']) ? $_GET['id'] : die('ID produk tidak ditemukan.');

// Query untuk menghapus produk berdasarkan ID
$deleteSql = "DELETE FROM products WHERE id = :id";
$stmt = $pdo->prepare($deleteSql);

// Bind parameter ID ke statement SQL
$stmt->bindParam(':id', $id);

// Eksekusi statement
if ($stmt->execute()) {
    echo "Produk berhasil dihapus.";
} else {
    echo "Gagal menghapus produk.";
}
?>
