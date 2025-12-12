<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
  header("Location: ../pages/login.php");
}
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
      <li><a href="pelanggan.php">Pelanggan</a></li>
      <li><a href="laporan.php">Laporan</a></li>
      <li><a href="admin_contact.php">Pesan</a></li>
      <li><a href="../pages/home.php" class="logout">Logout</a></li>
    </ul>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <header class="topbar">
      <h1>Dashboard Admin</h1>
      <p>Selamat datang, <b><?= $_SESSION['nama']; ?></b></p>
    </header>

    <!-- STATISTIK -->
    <section class="stats">
      <div class="card">Total Obat <h3>120</h3></div>
      <div class="card">Transaksi <h3>54</h3></div>
      <div class="card">Pelanggan <h3>89</h3></div>
      <div class="card">Pendapatan <h3>Rp 3.200.000</h3></div>
    </section>

  </main>

</div>

</body>
</html>


<a href="../auth/logout.php">Logout</a>
