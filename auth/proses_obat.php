<?php
include "../config/database.php";

$nama = $_POST['nama_obat'];
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$expired = $_POST['expired'];
$deskripsi = $_POST['deskripsi'];

$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];
move_uploaded_file($tmp, "../uploads/" . $gambar);

mysqli_query($conn, "INSERT INTO obat 
(nama_obat, kategori, harga, stok, expired, deskripsi, gambar)
VALUES 
('$nama','$kategori','$harga','$stok','$expired','$deskripsi','$gambar')");

header("location:../admin/data_obat.php");
