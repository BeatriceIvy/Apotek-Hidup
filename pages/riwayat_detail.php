<?php
session_start();
include "../config/database.php";

/* proteksi user */
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: riwayat_transaksi.php");
    exit;
}

$id_transaksi = $_GET['id'];
$user_id = $_SESSION['id_user'];

/* Ambil data transaksi */
$query = $conn->prepare("SELECT * FROM transaksi WHERE id_transaksi = ? AND id_user = ?");
$query->bind_param("ii", $id_transaksi, $user_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo "Transaksi tidak ditemukan.";
    exit;
}

$transaksi = $result->fetch_assoc();

/* Ambil detail produk transaksi */
$details = $conn->prepare("
    SELECT d.id_obat, o.nama_obat, o.harga, d.qty 
    FROM detail_transaksi d 
    JOIN obat o ON d.id_obat = o.id_obat 
    WHERE d.id_transaksi = ?
");
$details->bind_param("i", $id_transaksi);
$details->execute();
$details_result = $details->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="../assets/css/riwayat_detail.css">
    <link rel="icon" href="../assets/image/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2 class="page-title">Detail Transaksi #<?= $transaksi['id_transaksi'] ?></h2>

    <div class="transaction-summary">
        <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($transaksi['tanggal'])) ?></p>
        <p><strong>Status:</strong> 
            <span class="status <?= strtolower($transaksi['status']) ?>">
                <?= ucfirst($transaksi['status']) ?>
            </span>
        </p>
    </div>

    <table class="transaction-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; $total = 0; ?>
            <?php while($row = $details_result->fetch_assoc()): ?>
                <?php $subtotal = $row['harga'] * $row['qty']; ?>
                <?php $total += $subtotal; ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($row['nama_obat']) ?></td>
                    <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
                    <td><?= $row['qty'] ?></td>
                    <td>Rp <?= number_format($subtotal,0,',','.') ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="total-label">Total</td>
                <td class="total-value">Rp <?= number_format($total,0,',','.') ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="actions">
        <a href="riwayat_transaksi.php" class="btn-back">Kembali</a>
    </div>
</div>

</body>
</html>
