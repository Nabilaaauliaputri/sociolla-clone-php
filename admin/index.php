<?php
session_start();
// Karena file ini ada di dalam folder 'admin', kita naik satu tingkat (../) untuk ambil config
include '../config.php';

// Proteksi halaman: Jika belum login atau bukan admin, tendang balik ke login.php
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Anda harus login sebagai admin!'); window.location='../login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Sociolla Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container">
            <span class="navbar-brand">Admin Panel - Sociolla Clone</span>
            <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h2>
        <p>Gunakan menu di bawah.</p>
        <hr>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card p-4 shadow-sm">
                    <h4>Kelola Produk</h4>
                    <a href="produk.php" class="btn btn-primary mt-2">Buka Produk</a>
                </div>
            </div>
            </div>
    </div>
</body>
</html>