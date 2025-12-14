<?php
include 'koneksi.php';
include 'header.php';

$id = $_GET['id'] ?? 0;

// Ambil data pesanan
$data = mysqli_query($conn, "SELECT * FROM orders WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    echo "<p style='text-align:center;'>Data pesanan tidak ditemukan</p>";
    include 'footer.php';
    exit;
}

// Proses update qty
if (isset($_POST['update'])) {
    $qty   = (int) $_POST['qty'];
    if ($qty < 1) $qty = 1;

    $harga = $row['harga'];
    $total = $harga * $qty;

    mysqli_query($conn, "UPDATE orders SET
        qty = $qty,
        total = $total
        WHERE id = $id
    ");

    header("Location: detail_pesanan.php");
    exit;
}
?>

<section class="menu-section">
    <h2>Edit Jumlah Pesanan</h2>

    <form method="post" style="max-width:400px;margin:0 auto;">
        
        <label>Nama Menu</label>
        <input type="text" value="<?= htmlspecialchars($row['nama_menu']) ?>" readonly>

        <label>Harga</label>
        <input type="text" value="Rp <?= number_format($row['harga']) ?>" readonly>

        <label>Jumlah (Qty)</label>
        <input type="number" name="qty" value="<?= $row['qty'] ?>" min="1" required>

        <br><br>
        <button type="submit" name="update">Update Jumlah</button>
    </form>
</section>

<?php include 'footer.php'; ?>
