<?php
// 1. MEMULAI SESSION & KONEKSI
session_start();
include '../config.php';

// 2. PROTEKSI HALAMAN
// Mengecek apakah yang mengakses adalah admin yang sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("location:../login.php");
    exit();
}

// 3. PROSES SIMPAN DATA (Jika tombol Simpan diklik)
if (isset($_POST['simpan'])) {
    $nama_brand  = $_POST['nama_brand'];
    $nama_produk = $_POST['nama_produk'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $gambar      = $_POST['gambar']; // Sementara kita input nama file secara manual

    // Query SQL untuk memasukkan data ke tabel produk
    $sql = "INSERT INTO produk (nama_brand, nama_produk, harga, stok, gambar) 
            VALUES ('$nama_brand', '$nama_produk', '$harga', '$stok', '$gambar')";
    
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        echo "<script>alert('Data Berhasil Ditambahkan!'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal Menambah Data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Tambah Produk Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Brand</label>
                            <input type="text" name="nama_brand" class="form-control" placeholder="Contoh: AVOSKIN" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Serum Vitamin C" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga (Angka saja)</label>
                            <input type="number" name="harga" class="form-control" placeholder="Contoh: 150000" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama File Gambar</label>
                            <input type="text" name="gambar" class="form-control" placeholder="Contoh: serum.png" required>
                            <small class="text-muted text-italic">*Pastikan file sudah ada di folder asset/img/</small>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="produk.php" class="btn btn-secondary">Batal</a>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>