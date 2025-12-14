<?php
// Matikan notice (optional, aman di localhost)
error_reporting(E_ALL & ~E_NOTICE);

include 'header.php';
include 'koneksi.php';

// Pastikan koneksi OK
if (!$conn) {
    echo "<p style='text-align:center;color:red;'>Koneksi database gagal</p>";
    include 'footer.php';
    exit;
}

// Cek tabel orders ada atau tidak
$cekTabel = mysqli_query($conn, "SHOW TABLES LIKE 'orders'");
if (!$cekTabel || mysqli_num_rows($cekTabel) == 0) {
    echo "<p style='text-align:center;color:red;'>Tabel orders belum dibuat</p>";
    include 'footer.php';
    exit;
}

// Ambil data pesanan
$data = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
if (!$data) {
    echo "<p style='text-align:center;color:red;'>Query gagal</p>";
    include 'footer.php';
    exit;
}
?>

<section class="menu-section">
    <h2>Detail Pesanan</h2>

    <table border="1" cellpadding="10" cellspacing="0" style="margin:20px auto; width:90%;">
    <tr>
        <th>No</th>
        <th>Nama Menu</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>

    <?php if (mysqli_num_rows($data) == 0): ?>
        <tr>
            <td colspan="7" align="center">Belum ada pesanan</td>
        </tr>
    <?php else: ?>
        <?php $no=1; while($row = mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_menu']) ?></td>
            <td>Rp <?= number_format($row['harga']) ?></td>
            <td><?= $row['qty'] ?></td>
            <td>Rp <?= number_format($row['total']) ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
                <a href="edit_pesanan.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
                <a href="hapus_pesanan.php?id=<?= $row['id'] ?>"
                   onclick="return confirm('Yakin hapus pesanan ini?')">🗑️ Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php endif; ?>
</table>

</section>

<?php include 'footer.php'; ?>
