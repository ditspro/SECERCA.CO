<?php
include 'koneksi.php';

$id = $_GET['id'] ?? 0;

if ($id) {
    mysqli_query($conn, "DELETE FROM orders WHERE id=$id");
}

header("Location: detail_pesanan.php");
