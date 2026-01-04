<?php
// Konfigurasi Database
$host = "localhost";
$user = "root";      // Default XAMPP
$pass = "";          // Default XAMPP kosong
$db   = "sociolla_clone"; // Nama database yang kamu buat tadi

// Perintah untuk mengkoneksikan PHP ke MySQL
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek apakah koneksi berhasil atau tidak
if (!$koneksi) {
    // Jika gagal, tampilkan pesan error
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}