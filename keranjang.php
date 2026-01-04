<?php
session_start();
include 'config.php';

// Proteksi: Jika keranjang kosong, balikkan ke index
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    echo "<script>alert('Keranjang belanja kosong, yuk belanja dulu!'); window.location='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja - Sociolla Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="fw-bold mb-4">🛒 Keranjang Belanja</h2>
    <div class="card shadow border-0">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $total = 0;
                    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : 
                        $ambil = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
                        $data = mysqli_fetch_assoc($ambil);
                        $subtotal = $data['harga'] * $jumlah;
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['nama_produk']; ?></td>
                        <td>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $jumlah; ?></td>
                        <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                        <td>
                            <a href="hapus_keranjang.php?id=<?php echo $id_produk; ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <?php $total += $subtotal; endforeach; ?>
                </tbody>
                <tfoot class="fw-bold">
                    <tr>
                        <td colspan="4" class="text-end">Total:</td>
                        <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="mt-3">
                <a href="index.php" class="btn btn-secondary">Lanjut Belanja</a>
                <a href="checkout_final.php" class="btn btn-success">Checkout Sekarang</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>