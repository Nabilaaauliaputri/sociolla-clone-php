<?php
// 1. MEMULAI SESSION & KONEKSI
// Session digunakan untuk mengecek login, config untuk koneksi ke database
session_start();
include '../config.php';

// 2. PROTEKSI HALAMAN ADMIN
// Jika user bukan admin, maka akan dialihkan kembali ke halaman login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("location:../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - Admin Sociolla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --sociolla-pink: #db3a78; }
        .bg-pink { background-color: var(--sociolla-pink); color: white; }
        .badge-pending { background-color: #ffc107; color: black; } /* Kuning untuk menunggu */
        .badge-proses { background-color: #0dcaf0; color: white; }   /* Biru untuk dikemas */
        .badge-selesai { background-color: #198754; color: white; }  /* Hijau untuk selesai */
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
    <h2 class="fw-bold mb-4">Daftar Pesanan Masuk</h2>

    <div class="card shadow border-0" style="border-radius: 15px;">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-pink text-white">
                    <tr>
                        <th class="ps-4 py-3">No</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // 3. QUERY JOIN TABLE
                    // Kita menggabungkan tabel pesanan, users, dan produk agar bisa mendapatkan nama user dan nama produk sekaligus
                    $query = mysqli_query($koneksi, "SELECT pesanan.*, users.nama, produk.nama_produk, produk.harga 
                                                     FROM pesanan 
                                                     JOIN users ON pesanan.id_user = users.id_user 
                                                     JOIN produk ON pesanan.id_produk = produk.id_produk 
                                                     ORDER BY tanggal_pesan DESC");

                    // Cek jika ada pesanan
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $total = $row['harga'] * $row['jumlah'];
                    ?>
                    <tr class="align-middle">
                        <td class="ps-4"><?php echo $no++; ?></td>
                        <td><?php echo date('d M Y', strtotime($row['tanggal_pesan'])); ?></td>
                        <td class="fw-bold"><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['nama_produk']; ?></td>
                        <td><?php echo $row['jumlah']; ?> pcs</td>
                        <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                        <td>
                            <span class="badge <?php 
                                if($row['status'] == 'Pending') echo 'badge-pending';
                                elseif($row['status'] == 'Selesai') echo 'badge-selesai';
                                else echo 'badge-proses';
                            ?> p-2">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="update_status.php?id=<?php echo $row['id_pesanan']; ?>" class="btn btn-outline-primary btn-sm">Update Status</a>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        // Jika belum ada yang belanja
                        echo "<tr><td colspan='8' class='text-center py-5 text-muted'>Belum ada pesanan masuk.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-4 text-center">
        <a href="index.php" class="text-muted text-decoration-none">← Kembali ke Dashboard</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>