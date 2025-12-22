<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$id = intval($_GET['id']);

/* =========================
   UPDATE STATUS (FIX)
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    $status = $_POST['status'];

    $stmt = $conn->prepare(
        "UPDATE transaksi SET status=? WHERE id_transaksi=?"
    );
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    header("Location: transaksi_detail.php?id=$id");
    exit;
}

/* =========================
   FETCH DATA
========================= */
$trx = $conn->query(
    "SELECT * FROM transaksi WHERE id_transaksi=$id"
)->fetch_assoc();

$detail = $conn->query(
    "SELECT * FROM detail_transaksi WHERE id_transaksi=$id"
);
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Apotek Hidup</title>
    <link rel="stylesheet" href="../assets/css/detail_transaksi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="../assets/image/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">

        <div class="header">
            <h2>Detail Transaksi #<?= $trx['id_transaksi'] ?></h2>
            <span class="status <?= $trx['status'] ?>">
                <?= ucfirst($trx['status']) ?>
            </span>
        </div>

        <div class="info">
            <p><b>Tanggal:</b> <?= date('d-m-Y H:i', strtotime($trx['tanggal'])) ?></p>
            <p><b>Nama Penerima:</b> <?= $trx['nama_penerima'] ?></p>
            <p><b>No HP:</b> <?= $trx['no_hp'] ?></p>
            <p><b>Alamat:</b> <?= $trx['alamat'] ?></p>
        </div>

        <form method="POST" action="">
            <select name="status">
                <option value="pending" <?= $trx['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="diproses" <?= $trx['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                <option value="selesai" <?= $trx['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
            </select>
            <button type="submit" name="update">Update Status</button>
        </form>

        <table>
            <tr>
                <th>Nama Obat</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>

            <?php while ($d = $detail->fetch_assoc()): ?>
                <tr>
                    <td><?= $d['nama_obat'] ?></td>
                    <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                    <td><?= $d['qty'] ?></td>
                    <td>Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <div class="total">
            Total: Rp <?= number_format($trx['total'], 0, ',', '.') ?>
        </div>

        <a href="transaksi.php" class="back">← Kembali ke Transaksi</a>

    </div>

</body>

</html>