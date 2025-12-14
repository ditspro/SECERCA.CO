<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$cartCount = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['qty'] ?? 0;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SECERCA Coffee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo-container">
        <img src="img/hero-bg.jpeg" alt="Logo Secerca">
        <h1>SECERCA.CO</h1>
    </div>
<nav>
    <a href="index.php#home">Home</a>
    <a href="index.php#menu">Menu</a>
    <a href="index.php#about">Tentang</a>
    <a href="index.php#contact">Kontak</a>

    <!-- MENU DETAIL PESANAN -->
    <a href="detail_pesanan.php" class="cart-header">
        🛒 Detail Pesanan (<span id="cartCount"><?= $cartCount ?></span>)
    </a>
</nav>

</header>
