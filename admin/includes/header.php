
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sociolla Clone - Tugas Besar</title>
    
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    
    <link href="assets/css/styles.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand fw-bold text-danger" href="index.php">SOCIOLLA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <?php if(isset($_SESSION['nama'])): ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout (<?php echo $_SESSION['nama']; ?>)</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="button">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>