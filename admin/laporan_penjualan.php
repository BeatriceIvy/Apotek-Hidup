<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../pages/login.php");
    exit;
}


// فلترة التاريخ
$tanggal_mulai = $_GET['tanggal_mulai'] ?? date('Y-m-01');
$tanggal_akhir = $_GET['tanggal_akhir'] ?? date('Y-m-d');

// ===== STATISTIK DARI DATABASE =====

// Total transaksi
$qTransaksi = $conn->query("
    SELECT COUNT(*) AS total 
    FROM transaksi 
    WHERE DATE(tanggal) BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'
");
$total_transaksi = $qTransaksi->fetch_assoc()['total'];

// Total pendapatan
$qPendapatan = $conn->query("
    SELECT SUM(total) AS total 
    FROM transaksi 
    WHERE status='selesai'
    AND DATE(tanggal) BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'
");
$total_pendapatan = $qPendapatan->fetch_assoc()['total'] ?? 0;

// Total pelanggan
$qPelanggan = $conn->query("
    SELECT COUNT(*) AS total 
    FROM users 
    WHERE role='user'
");
$total_pelanggan = $qPelanggan->fetch_assoc()['total'];

// Total obat
$qObat = $conn->query("SELECT COUNT(*) AS total FROM obat");
$total_obat = $qObat->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan - Apotek Hidup</title>
    <link rel="stylesheet" href="../assets/css/laporan.css">
    <link rel="icon" type="image/png" href="../assets/image/logo.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <div class="admin-wrapper">

        <main class="main-content">

            <div class="topbar">
                <div>
                    <h1>Laporan</h1>
                    <p>Laporan berdasarkan database Apotek Hidup</p>
                </div>
                <a href="dashboard.php" class="btn-primary samping">Kembali</a>
                <button class="btn-download" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>

            <div class="filter-box">
                <form method="GET" class="date-inputs">
                    <input type="date" name="tanggal_mulai" value="<?= $tanggal_mulai ?>">
                    <span>→</span>
                    <input type="date" name="tanggal_akhir" value="<?= $tanggal_akhir ?>">
                    <button class="btn-filter">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </form>
            </div>

            <!-- STATISTIK -->
            <section class="statistik-box">
                <div class="stat-card green">
                    <h4>Total Transaksi</h4>
                    <p><?= $total_transaksi ?></p>
                </div>

                <div class="stat-card blue">
                    <h4>Total Pendapatan</h4>
                    <p>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></p>
                </div>

                <div class="stat-card orange">
                    <h4>Total Pelanggan</h4>
                    <p><?= $total_pelanggan ?></p>
                </div>

                <div class="stat-card purple">
                    <h4>Total Obat</h4>
                    <p><?= $total_obat ?></p>
                </div>
            </section>

        </main>
    </div>

</body>

</html>