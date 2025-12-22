<?php
session_start();
require_once __DIR__ . "/../config/database.php";

// TOTAL OBAT
$q = $conn->query("SELECT COUNT(*) AS total FROM obat");
$total_obat = $q ? $q->fetch_assoc()['total'] : 0;

// TOTAL TRANSAKSI
$q = $conn->query("SELECT COUNT(*) AS total FROM transaksi");
$total_transaksi = $q ? $q->fetch_assoc()['total'] : 0;

// TOTAL PELANGGAN
$q = $conn->query("SELECT COUNT(*) AS total FROM pelanggan");
$total_pelanggan = $q ? $q->fetch_assoc()['total'] : 0;

// TOTAL PENDAPATAN
$q = $conn->query("
    SELECT IFNULL(SUM(total),0) AS total 
    FROM transaksi 
    WHERE status IN ('diproses','selesai')
");
$total_pendapatan = $q ? $q->fetch_assoc()['total'] : 0;

$q_today = $conn->query("
    SELECT COUNT(*) AS total 
    FROM transaksi 
    WHERE DATE(tanggal) = CURDATE()
");
$trx_today = $q_today->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Apotek Hidup</title>
  <link rel="stylesheet" href="../assets/css/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="icon" type="image/png" href="../assets/image/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
</head>

<div class="admin-wrapper">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <h2>ADMIN</h2>
    <ul>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="data_obat.php">Data Obat</a></li>
      <li><a href="transaksi.php">Transaksi</a></li>
      <li><a href="data_pelanggan.php">Pelanggan</a></li>
      <li><a href="laporan_penjualan.php">Laporan</a></li>
      <li><a href="admin_contact.php">Pesan</a></li>
      <li><a href="../pages/home.php" class="logout">Logout</a></li>
    </ul>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <header class="topbar">
      <h1>Dashboard Admin</h1>
      <p>Selamat datang, <b><?= $_SESSION['nama']; ?></b></p>
      <p>Transaksi hari ini: <b><?= $trx_today ?></b></p>

    </header>

    <!-- STATISTIK -->
    <section class="stats">
      <div class="card">
        <h3>Total Obat</h3>
        <p><?php echo $total_obat; ?><p>
      </div>
      <div class="card">
        <h3>Total Transaksi</h3>
        <p><?php echo $total_transaksi; ?></p>
      </div>
      <div class="card">
        <h3>Total Pelanggan</h3>
        <p><?php echo $total_pelanggan; ?></p>
      </div>
      <div class="card">
        <h3>Pendapatan</h3>
        <p>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></p>
      </div>
    </section>

  </main>

</div>

</body>

</html>


<a href="../auth/logout.php">Logout</a>