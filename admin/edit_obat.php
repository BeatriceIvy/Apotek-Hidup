<?php
session_start();
include "../config/database.php";

/* =====================
   CEK LOGIN ADMIN
===================== */
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}

/* =====================
   CEK ID OBAT
===================== */
if (!isset($_GET['id'])) {
    header("Location: data_obat.php");
    exit;
}

$id = (int) $_GET['id'];

/* =====================
   AMBIL DATA OBAT
===================== */
$obat = $conn->query("SELECT * FROM obat WHERE id_obat=$id")->fetch_assoc();
if (!$obat) {
    echo "Obat tidak ditemukan";
    exit;
}

/* =====================
   UPDATE DATA
===================== */
if (isset($_POST['update'])) {

    $nama  = $_POST['nama_obat'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];
    $desk  = $_POST['deskripsi'];

    // default gambar lama
    $gambar = $obat['gambar'];

    // jika upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar = time() . "_" . uniqid() . "." . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/image/" . $gambar);
    }

    $stmt = $conn->prepare("
        UPDATE obat SET
            nama_obat=?,
            harga=?,
            stok=?,
            deskripsi=?,
            gambar=?
        WHERE id_obat=?
    ");
    $stmt->bind_param("siissi", $nama, $harga, $stok, $desk, $gambar, $id);
    $stmt->execute();

    echo "<script>alert('Obat berhasil diperbarui');location.href='data_obat.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Edit Obat</title>
    <link rel="stylesheet" href="../assets/css/edit_obat.css">
    <link rel="icon" type="image/png" href="../assets/image/logo.png">
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Edit Data Obat</h2>

        <form action="../auth/proses_obat.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_obat" value="<?= $obat['id_obat'] ?>">

            <div class="form-group">
                <label>Nama Obat</label>
                <input type="text" name="nama_obat" value="<?= $obat['nama_obat'] ?>" required>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" value="<?= $obat['harga'] ?>" required>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" value="<?= $obat['stok'] ?>" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" value="<?= $obat['kategori'] ?>">
            </div>

            <div class="form-group full">
                <label>Gambar Obat</label>
                <input type="file" name="gambar">
                <small>Biarkan kosong jika tidak ingin mengganti</small>
            </div>

            <div class="form-actions">
                <a href="data_obat.php" class="btn-cancel">Batal</a>
                <button type="submit" name="update" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
