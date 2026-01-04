<?php
session_start();
include 'config.php';

// 1. PROTEKSI LOGIN
// Keranjang hanya bisa diproses jika user sudah login
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Silakan login terlebih dahulu untuk konfirmasi pesanan!'); window.location='login.php';</script>";
    exit();
}

// 2. CEK APAKAH KERANJANG KOSONG
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    echo "<script>alert('Keranjang Anda kosong!'); window.location='index.php';</script>";
    exit();
}

$id_user = $_SESSION['id_user'];
$tanggal = date("Y-m-d H:i:s");

// 3. PROSES PEMINDAHAN DATA (LOOPING)
// Karena di keranjang bisa ada banyak produk, kita pakai foreach
foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {

    // A. Ambil stok produk terbaru dari database
    $ambil = mysqli_query($koneksi, "SELECT stok FROM produk WHERE id_produk = '$id_produk'");
    $data = mysqli_fetch_assoc($ambil);
    $stok_sekarang = $data['stok'];

    // B. Cek apakah stok cukup
    if ($stok_sekarang >= $jumlah) {
        // C. Hitung stok baru
        $stok_baru = $stok_sekarang - $jumlah;

        // D. Simpan ke tabel pesanan
        mysqli_query($koneksi, "INSERT INTO pesanan (id_user, id_produk, jumlah, status, tanggal_pesan) 
                                VALUES ('$id_user', '$id_produk', '$jumlah', 'Pending', '$tanggal')");

        // E. Update stok produk di database
        mysqli_query($koneksi, "UPDATE produk SET stok = '$stok_baru' WHERE id_produk = '$id_produk'");
    } else {
        echo "<script>alert('Maaf, stok salah satu produk tidak cukup.'); window.location='keranjang.php';</script>";
        exit();
    }
}

// 4. KOSONGKAN KERANJANG
// Setelah berhasil dipindah ke database, keranjang di session harus dihapus
unset($_SESSION['keranjang']);

echo "<script>alert('Pesanan berhasil dibuat! Silakan cek status pesanan Anda.'); window.location='index.php';</script>";
?>