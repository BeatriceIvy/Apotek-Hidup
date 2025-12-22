<?php
session_start();
include "../config/database.php";

/* PROTEKSI ADMIN */
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

/* =====================
   STATISTIK
===================== */
$subtotal  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total) AS total FROM transaksi"))['total'] ?? 0;
$pending   = mysqli_num_rows(mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE status='pending'"));
$diproses  = mysqli_num_rows(mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE status='diproses'"));
$selesai   = mysqli_num_rows(mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE status='selesai'"));

/* =====================
   DATA TRANSAKSI
===================== */
$data = mysqli_query($conn, "
    SELECT 
        t.id_transaksi,
        t.tanggal,
        t.total,
        t.status,
        GROUP_CONCAT(td.nama_obat SEPARATOR ', ') AS obat_list
    FROM transaksi t
    LEFT JOIN detail_transaksi td 
        ON t.id_transaksi = td.id_transaksi
    GROUP BY t.id_transaksi
    ORDER BY t.tanggal DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Apotek Hidup</title>
    <link rel="stylesheet" href="../assets/css/transaksi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="../assets/image/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>

<div class="admin-wrapper">
    <!-- MAIN CONTENT -->
    <main class="main-content">
        <header class="topbar">
            <div>
                <h1>Transaksi</h1>
                <p>Daftar semua transaksi yang terjadi di Apotek Hidup</p>
            </div>
            <a href="tambah_transaksi.php" class="btn-primary samping">+ Tambah Transaksi</a>
            <a href="dashboard.php" class="btn-primary">Kembali</a>
        </header>

        <!-- STATISTIK -->
        <section class="stats">
            <div class="stat-card yellow">
                <div class="stat-icon">💰</div>
                <div class="stat-info">
                    <h3>Total Transaksi</h3>
                    <p><?= $subtotal ?></p>
                </div>
            </div>
            <div class="stat-card blue">
                <div class="stat-icon">📋</div>
                <div class="stat-info">
                    <h3>Pending</h3>
                    <p><?= $pending ?></p>
                </div>
            </div>
            <div class="stat-card teal">
                <div class="stat-icon">🚚</div>
                <div class="stat-info">
                    <h3>Diproses</h3>
                    <p><?= $diproses ?></p>
                </div>
            </div>
            <div class="stat-card pink">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <h3>Selesai</h3>
                    <p><?= $selesai ?></p>
                </div>
            </div>
        </section>

        <!-- TABLE -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Obat</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($data) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($data)): 
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
                        <td><?= !empty($row['obat_list']) ? $row['obat_list'] : '-' ?></td>
                        <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                        <td>
                            <span class="status-badge status-<?= strtolower($row['status']) ?>">
                                <?= ucfirst($row['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="transaksi_detail.php?id=<?= $row['id_transaksi'] ?>" class="btn-detail">Detail</a>
                        </td>
                        <td>
                            <a href="../auth/transaksi_process.php?hapus=<?= $row['id_transaksi'] ?>" 
                               class="btn-hapus" 
                               onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                        endwhile;
                    } else {
                        echo '<tr><td colspan="7" style="text-align:center; padding:40px; color:#7f8c8d;">Belum ada transaksi</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>