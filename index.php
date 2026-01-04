<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sociolla Clone - Beauty Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --sociolla-pink: #db3a78; }
        .btn-pink { background-color: var(--sociolla-pink); color: white; border-radius: 20px; }
        .btn-pink:hover { background-color: #b52a5f; color: white; }
        
        /* Gaya Navbar */
        .navbar-brand { display: flex; align-items: center; text-decoration: none; }
        .navbar-brand img { height: 40px; margin-right: 10px; }
        .logo-text { color: var(--sociolla-pink); font-weight: 800; font-size: 24px; letter-spacing: 1px; }
        
        .card-produk { border: none; transition: 0.3s; }
        .card-produk:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="asset/img/logo.png" alt="Logo" onerror="this.style.display='none'">
            <span class="logo-text">SOCIOLLA</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-secondary position-relative px-3 me-3" href="keranjang.php">
                        🛒 Keranjang
                        <?php if(isset($_SESSION['keranjang']) && count($_SESSION['keranjang']) > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo count($_SESSION['keranjang']); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </li>
                
                <?php if(isset($_SESSION['id_user'])): ?>
                    <li class="nav-item">
                        <span class="nav-link fw-bold text-dark">Halo, <?php echo $_SESSION['nama']; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-pink btn-sm ms-lg-3 px-3" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-pink btn-sm ms-lg-3 px-3" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="mb-4 shadow-sm rounded-3 overflow-hidden">
        <img src="asset/img/banner_home.png" class="img-fluid w-100" alt="Promo Banner" 
             onerror="this.src='https://via.placeholder.com/1200x400?text=Banner+Home+Belum+Ada+di+Folder+Asset'">
    </div>

    <h4 class="fw-bold mb-4">New Arrivals</h4>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php
        $ambildata = mysqli_query($koneksi, "SELECT * FROM produk");
        while($row = mysqli_fetch_assoc($ambildata)):
        ?>
        <div class="col">
            <div class="card h-100 card-produk shadow-sm p-2">
                <img src="asset/img/<?php echo $row['gambar']; ?>" class="card-img-top p-2" style="height: 180px; object-fit: contain;">
                <div class="card-body text-center">
                    <small class="text-muted text-uppercase fw-bold">
                        <?php echo $row['nama_brand'] ?? $row['brand'] ?? 'Sociolla'; ?>
                    </small>
                    <h6 class="card-title fw-bold text-truncate my-2"><?php echo $row['nama_produk']; ?></h6>
                    <p class="fw-bold mb-1" style="color: var(--sociolla-pink);">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                    <p class="text-muted small mb-3">Stok: <?php echo $row['stok']; ?></p>
                    
                    <a href="proses_keranjang.php?id=<?php echo $row['id_produk']; ?>" class="btn btn-pink btn-sm w-100 py-2">
                        + Keranjang
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<footer class="text-center py-5 mt-5 bg-white border-top text-muted">
    <p>&copy; 2026 Sociolla</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>