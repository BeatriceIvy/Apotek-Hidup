<?php
session_start();
include "../config/database.php";

/* optional: proteksi admin */
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan</title>
    <link rel="stylesheet" href="../assets/css/tambah_pelanggan.css">
    <link rel="icon" type="image/png" href="../assets/image/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Tambah Pelanggan</h2>
        <p class="subtitle">Isi data pelanggan baru</p>

        <form action="../auth/proses_pelanggan.php" method="POST">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Nama pelanggan" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="email@example.com">
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="number" name="no_hp" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group full">
                <label>Alamat</label>
                <textarea name="alamat" placeholder="Alamat lengkap pelanggan" required></textarea>
            </div>

            <div class="form-actions">
                <a href="data_pelanggan.php" class="btn-cancel">Batal</a>
                <button type="submit" name="tambah" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
