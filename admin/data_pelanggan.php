<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}

$data = $conn->query("
    SELECT id_pelanggan, nama, no_hp, alamat, created_at
    FROM pelanggan
    ORDER BY id_pelanggan DESC
");

$search = $_GET['search'] ?? '';

$where = '';
if ($search) {
    $search = $conn->real_escape_string($search);
    $where = "WHERE nama LIKE '%$search%' OR no_hp LIKE '%$search%'";
}

$data = $conn->query("
    SELECT * FROM pelanggan
    $where
    ORDER BY id_pelanggan DESC
");

$total = $conn->query("SELECT COUNT(*) total FROM pelanggan")->fetch_assoc()['total'];
$no_hp = $conn->query("SELECT COUNT(*) total FROM pelanggan WHERE no_hp IS NOT NULL")->fetch_assoc()['total'];
$alamat = $conn->query("SELECT COUNT(*) total FROM pelanggan WHERE alamat IS NOT NULL")->fetch_assoc()['total'];

?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan - Apotek Hidup</title>
    <link rel="stylesheet" href="../assets/css/data_pelanggan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="../assets/image/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <main class="main-content">
        <header class="topbar">
            <div>
                <h1>Pelanggan</h1>
                <p>Daftar pengguna yang terdaftar di sistem Apotek Hidup</p>
            </div>
            <a href="tambah_pelanggan.php" class="btn-primary samping">+ Tambah Pelanggan</a>
            <a href="dashboard.php" class="btn-primary">Kembali</a>
        </header>

        <section class="stats">
            <div class="stat-card teal">
                <div class="stat-icon">👥</div>
                <div class="stat-info">
                    <h3>Total Pelanggan</h3>
                    <p><?= $total ?></p>
                </div>
            </div>

            <div class="stat-card yellow">
                <div class="stat-icon">📞</div>
                <div class="stat-info">
                    <h3>No HP</h3>
                    <p><?= $no_hp ?></p>
                </div>
            </div>

            <div class="stat-card pink">
                <div class="stat-icon">📍</div>
                <div class="stat-info">
                    <h3>Alamat Tersimpan</h3>
                    <p><?= $alamat ?></p>
                </div>
            </div>

            <div class="stat-card">
                <form method="GET" class="search-form">
                    <input type="text" name="search" placeholder="Cari pelanggan..." value="<?= $search ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </section>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($data->num_rows > 0): ?>
                        <?php $no = 1;
                        while ($row = mysqli_fetch_assoc($data)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($row['no_hp'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($row['alamat'] ?? '-') ?></td>
                                <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
                                <td>
                                    <a href="detail_pelanggan.php?id=<?= $row['id_pelanggan'] ?>" class="btn-detail">
                                        Detail
                                    </a>
                                    <a href="pelanggan.php?hapus=<?= $row['id_pelanggan'] ?>" class="btn-hapus"
                                        onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center; padding:30px; color:#7f8c8d;">
                                Belum ada data pelanggan
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

</body>

</html>