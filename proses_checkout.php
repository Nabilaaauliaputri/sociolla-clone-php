<?php
session_start();
include 'config.php';

// 1. CEK LOGIN
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
    exit();
}

$id_produk = $_GET['id']; 
$id_user   = $_SESSION['id_user']; 
$jumlah    = 1; 

// 2. AMBIL STOK LAMA
$ambil_stok = mysqli_query($koneksi, "SELECT stok FROM produk WHERE id_produk = '$id_produk'");
$data = mysqli_fetch_assoc($ambil_stok);
$stok_lama = $data['stok'];

// 3. HITUNG STOK BARU
$stok_baru = $stok_lama - $jumlah;

// 4. JALANKAN DUA PERINTAH SQL SEKALIGUS
// Simpan ke tabel pesanan
$query1 = mysqli_query($koneksi, "INSERT INTO pesanan (id_user, id_produk, jumlah, status) VALUES ('$id_user', '$id_produk', '$jumlah', 'Pending')");

// Kurangi stok di tabel produk
$query2 = mysqli_query($koneksi, "UPDATE produk SET stok = '$stok_baru' WHERE id_produk = '$id_produk'");

// 5. PENGECEKAN HASIL
if ($query1 && $query2) {
    echo "<script>alert('Sukses! Pesanan tercatat dan stok berkurang.'); window.location='index.php';</script>";
} else {
    // Jika gagal, tampilkan pesan error dari MySQL agar kita tahu salahnya di mana
    echo "Error SQL: " . mysqli_error($koneksi);
}
?>