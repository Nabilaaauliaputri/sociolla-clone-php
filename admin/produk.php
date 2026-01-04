<?php
// 1. MEMULAI SESSION
// Digunakan untuk mengecek apakah user sudah login atau belum melalui data di browser
session_start();

// 2. MENGHUBUNGKAN DATABASE
// '../' artinya keluar satu tingkat dari folder admin untuk mencari file config.php
include '../config.php';

// 3. PROTEKSI HALAMAN (KEAMANAN)
// Jika role di session bukan 'admin', maka paksa pindah ke halaman login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("location:../login.php");
    exit(); // Menghentikan seluruh script agar kode di bawah tidak dijalankan oleh penyusup
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Admin Sociolla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root { --sociolla-pink: #db3a78; }
        .bg-pink { background-color: var(--sociolla-pink); color: white; }
        .btn-pink { background-color: var(--sociolla-pink); color: white; border-radius: 20px; }
        .btn-pink:hover { background-color: #b82d63; color: white; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php">Admin Panel</a>
        <div class="ms-auto">
            <span class="text-white me-3">Halo, <?php echo $_SESSION['nama']; ?></span>
            <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Produk Toko</h2>
        <a href="tambah_produk.php" class="btn btn-pink">+ Tambah Produk Baru</a>
    </div>

    <div class="card shadow border-0" style="border-radius: 15px;">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-pink">
                    <tr>
                        <th class="ps-4 py-3">No</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Brand</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1; // Variabel bantuan untuk nomor urut di tabel
                    
                    // 4. QUERY MENGAMBIL DATA PRODUK
                    // Mengambil data dari tabel 'produk' dan diurutkan dari yang terbaru (DESC)
                    $query = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC");
                    
                    // 5. PERULANGAN (LOOPING) DATA
                    // Selama data di database masih ada, buatkan baris (tr) baru di tabel
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr class="align-middle">
                        <td class="ps-4"><?php echo $no++; ?></td>
                        <td>
                            <img src="../asset/img/<?php echo $row['gambar']; ?>" width="60" class="rounded border">
                        </td>
                        <td class="fw-bold"><?php echo $row['nama_produk']; ?></td>
                        <td><?php echo $row['nama_brand']; ?></td>
                        <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $row['stok']; ?></td>
                        <td class="text-center">
                            <a href="edit_produk.php?id=<?php echo $row['id_produk']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            
                            <a href="hapus_produk.php?id=<?php echo $row['id_produk']; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } // AKHIR DARI PERULANGAN ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-4 text-center">
        <a href="../index.php" class="text-muted text-decoration-none">← Lihat Tampilan Depan Web</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>