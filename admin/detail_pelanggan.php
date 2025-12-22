<?php
session_start();
include "../config/database.php";

/* proteksi admin */
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}

/* Ambil data pelanggan dari ID */
if (!isset($_GET['id'])) {
    header("Location: data_pelanggan.php");
    exit;
}

$id = $_GET['id'];

$query = $conn->prepare("SELECT * FROM pelanggan WHERE id_pelanggan = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo "Data tidak ditemukan";
    exit;
}

$pelanggan = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Pelanggan</title>
    <link rel="stylesheet" href="../assets/css/detail_pelanggan.css">
    <link rel="icon" type="image/png" href="../assets/image/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="card">
            <h2>Detail Pelanggan</h2>
            <p class="subtitle">Informasi lengkap pelanggan</p>

            <div class="detail-item">
                <label>Nama Lengkap:</label>
                <span><?= htmlspecialchars($pelanggan['nama']) ?></span>
            </div>
            <div class="detail-item">
                <label>Email:</label>
                <span><?= htmlspecialchars($pelanggan['email']) ?: '-' ?></span>
            </div>
            <div class="detail-item">
                <label>No HP:</label>
                <span><?= htmlspecialchars($pelanggan['no_hp']) ?></span>
            </div>
            <div class="detail-item">
                <label>Alamat:</label>
                <span><?= htmlspecialchars($pelanggan['alamat']) ?></span>
            </div>

            <div class="actions">
                <div class="actions">
                    <a href="data_pelanggan.php" class="btn-back">Kembali</a>
                    <a href="../auth/proses_pelanggan.php?hapus=<?= $pelanggan['id_pelanggan'] ?>" class="btn-delete"
                        onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">Hapus</a>
                </div>

            </div>
        </div>
    </div>

</body>

</html>