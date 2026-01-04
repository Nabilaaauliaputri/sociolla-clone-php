<?php
// 1. MEMULAI SESSION & KONEKSI
session_start();
include '../config.php';

// 2. PROTEKSI HALAMAN
// Mengecek apakah yang mengakses adalah admin. Jika tidak, akan dilempar ke login.php
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("location:../login.php");
    exit();
}

// 3. MENGAMBIL ID DARI URL
// Kita mengambil ID produk yang diklik dari halaman sebelumnya menggunakan metode GET
$id = $_GET['id'];

// 4. MENGAMBIL DATA LAMA DARI DATABASE
// Kita perlu menampilkan data lama di dalam form agar admin tahu apa yang mau diubah
$ambil_data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id'");
$row = mysqli_fetch_assoc($ambil_data);

// 5. PROSES UPDATE DATA (Jika tombol Update diklik)
if (isset($_POST['update'])) {
    $nama_brand  = $_POST['nama_brand'];
    $nama_produk = $_POST['nama_produk'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $gambar      = $_POST['gambar'];

    // Query SQL untuk memperbarui data berdasarkan ID produk tersebut
    $sql = "UPDATE produk SET 
            nama_brand = '$nama_brand', 
            nama_produk = '$nama_produk', 
            harga = '$harga', 
            stok = '$stok', 
            gambar = '$gambar' 
            WHERE id_produk = '$id'";
    
    $query = mysqli_query($koneksi, $sql);

    // Jika berhasil, munculkan notifikasi dan pindah ke halaman daftar produk
    if ($query) {
        echo "<script>alert('Data Berhasil Diperbarui!'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal Memperbarui Data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - Admin Sociolla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-header bg-warning text-dark fw-bold">
                    <h5 class="mb-0">Form Edit Produk</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Brand</label>
                            <input type="text" name="nama_brand" class="form-control" value="<?php echo $row['nama_brand']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" value="<?php echo $row['nama_produk']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga</label>
                            <input type="number" name="harga" class="form-control" value="<?php echo $row['harga']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Stok</label>
                            <input type="number" name="stok" class="form-control" value="<?php echo $row['stok']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama File Gambar</label>
                            <input type="text" name="gambar" class="form-control" value="<?php echo $row['gambar']; ?>" required>
                            <p class="mt-2">Preview Gambar Saat Ini:</p>
                            <img src="../asset/img/<?php echo $row['gambar']; ?>" width="100" class="border rounded">
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="produk.php" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" name="update" class="btn btn-warning px-4 fw-bold">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>