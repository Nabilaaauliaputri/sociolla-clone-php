<?php
session_start();
// Ambil ID produk dari URL
$id_produk = $_GET['id'];

// Logika Keranjang:
// Jika produk sudah ada di keranjang, jumlahnya ditambah 1
if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] += 1;
} 
// Jika belum ada, maka dianggap beli 1
else {
    $_SESSION['keranjang'][$id_produk] = 1;
}

// Setelah dicatat, lempar user ke halaman keranjang
echo "<script>alert('Produk berhasil masuk ke keranjang!'); window.location='keranjang.php';</script>";
?>