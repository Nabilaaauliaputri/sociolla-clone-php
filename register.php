<?php
include 'config.php';

if (isset($_POST['register'])) {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $role     = 'user';

    // Perbaikan Baris 12: Menggunakan mysqli_num_rows yang benar
    $cek_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Username sudah terdaftar, silakan gunakan yang lain!'); window.location='register.php';</script>";
    } else {
        // Simpan data ke tabel user
        $query = mysqli_query($koneksi, "INSERT INTO user (nama, username, password, role) VALUES ('$nama', '$username', '$password', '$role')");

        if ($query) {
            echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Registrasi Gagal: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sociolla Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --sociolla-pink: #db3a78; }
        body { background-color: #fce4ec; }
        .card-register { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .btn-pink { background-color: var(--sociolla-pink); color: white; border-radius: 20px; font-weight: bold; }
        .btn-pink:hover { background-color: #b52a5f; color: white; }
        .logo-text { color: var(--sociolla-pink); font-weight: 800; font-size: 28px; text-align: center; display: block; margin-bottom: 20px; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-5">
            <a href="index.php" class="logo-text">SOCIOLLA</a>
            <div class="card card-register p-4">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4">Buat Akun Baru</h4>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Pilih username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Buat password" required>
                        </div>
                        <button type="submit" name="register" class="btn btn-pink w-100 py-2 mt-3">DAFTAR SEKARANG</button>
                    </form>
                    <hr class="my-4">
                    <p class="text-center text-muted small">
                        Sudah punya akun? <a href="login.php" class="text-decoration-none" style="color: var(--sociolla-pink);">Login di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>