<?php
// 1. MEMULAI SESSION & KONEKSI
session_start();
include '../config.php';

// 2. PROTEKSI HALAMAN
// Memastikan hanya admin yang bisa menghapus data
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("location:../login.php");
    exit();
}

// 3. MENGAMBIL ID DARI URL
// Mengambil ID produk yang akan dihapus dari parameter URL (misal: hapus_produk.php?id=4)
$id = $_GET['id'];

// 4. PROSES HAPUS DATA
// Menjalankan perintah SQL DELETE untuk menghapus baris produk berdasarkan ID
$query_hapus = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = '$id'");

// 5. NOTIFIKASI DAN REDIRECT
// Jika berhasil dihapus, munculkan pesan dan kembali ke halaman produk.php
if ($query_hapus) {
    echo "<script>
            alert('Produk berhasil dihapus!');
            window.location='produk.php';
          </script>";
} else {
    // Jika gagal (misal karena ada kendala database)
    echo "<script>
            alert('Gagal menghapus produk!');
            window.location='produk.php';
          </script>";
}
?>