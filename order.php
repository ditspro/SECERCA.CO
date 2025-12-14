<?php
include 'koneksi.php';

header("Content-Type: text/plain");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Bukan POST";
    exit;
}

if (!isset($_POST['nama'], $_POST['harga'])) {
    echo "POST tidak lengkap";
    print_r($_POST);
    exit;
}

$nama  = mysqli_real_escape_string($conn, $_POST['nama']);
$harga = (int) $_POST['harga'];
$qty   = 1;
$total = $harga * $qty;

$sql = "INSERT INTO orders (nama_menu, harga, qty, total)
        VALUES ('$nama', $harga, $qty, $total)";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "SQL ERROR: " . mysqli_error($conn);
}
