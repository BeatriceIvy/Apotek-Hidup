<?php
session_start();
include "../config/database.php";

if (isset($_POST['tambah'])) {
    $nama   = $_POST['nama'];
    $email  = $_POST['email'];
    $no_hp  = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $stmt = $conn->prepare("
        INSERT INTO pelanggan (nama, email, no_hp, alamat)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("ssss", $nama, $email, $no_hp, $alamat);
    $stmt->execute();

    header("Location: ../admin/data_pelanggan.php");
    exit;
}
