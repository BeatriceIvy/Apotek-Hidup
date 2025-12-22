<?php
session_start();
include "../config/database.php";

/* proteksi user */
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id_user'];

/* Ambil data transaksi user */
$query = $conn->prepare("
    SELECT * FROM transaksi 
    WHERE id_user = ? 
    ORDER BY tanggal DESC
");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="../assets/css/riwayat_transaksi.css">
    <link rel="icon" href="../assets/image/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h2 class="page-title">Riwayat Transaksi</h2>

        <?php if ($result->num_rows > 0): ?>
            <div class="transaction-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="transaction-card">
                        <div class="transaction-info">
                            <p><strong>ID Transaksi:</strong> <?= $row['id_transaksi'] ?></p>
                            <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($row['tanggal'])) ?></p>
                            <p><strong>Total:</strong> Rp <?= number_format($row['total'], 0, ',', '.') ?></p>
                            <p><strong>Status:</strong>
                                <span class="status <?= strtolower($row['status']) ?>">
                                    <?= ucfirst($row['status']) ?>
                                </span>
                            </p>
                        </div>
                        <div class="transaction-actions">
                            <a href="riwayat_detail.php?id=<?= $row['id_transaksi'] ?>" class="btn-view">Lihat Detail</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="empty-message">Belum ada transaksi.</p>
        <?php endif; ?>
        <div class="actions">
            <a href="profile.php" class="btn-back">Kembali ke Riwayat Transaksi</a>
        </div>

    </div>

</body>

</html>