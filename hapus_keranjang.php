<?php
session_start();
$id_produk = $_GET['id'];

// Hapus produk spesifik dari session
unset($_SESSION['keranjang'][$id_produk]);

echo "<script>alert('Produk dihapus dari keranjang.'); window.location='keranjang.php';</script>";
?>