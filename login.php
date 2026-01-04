<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    // trim() digunakan untuk menghapus spasi di awal/akhir inputan
    $username = trim(mysqli_real_escape_string($koneksi, $_POST['username']));
    $password = trim(mysqli_real_escape_string($koneksi, $_POST['password']));

    // Query untuk mencari user
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        
        // Simpan data ke session
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama']    = $data['nama'];
        $_SESSION['role']    = $data['role'];

        echo "<script>alert('Selamat Datang, " . $data['nama'] . "!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Username atau Password Salah! Periksa kembali ketikan Anda.'); window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Sociolla Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fce4ec; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { border: none; border-radius: 15px; width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .btn-pink { background-color: #db3a78; color: white; border-radius: 20px; }
        .btn-pink:hover { background-color: #b52a5f; color: white; }
    </style>
</head>
<body>
    <div class="card p-4">
        <h3 class="text-center fw-bold mb-4" style="color: #db3a78;">LOGIN</h3>
        <form method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
            </div>
            <button type="submit" name="login" class="btn btn-pink w-100 py-2">MASUK</button>
            <p class="text-center mt-3 small">Belum punya akun? <a href="register.php" style="color: #db3a78;">Daftar di sini</a></p>
        </form>
    </div>
</body>
</html>