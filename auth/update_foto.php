<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    die("Not logged in");
}

if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== 0) {
    die("File tidak terkirim");
}

$id_user = $_SESSION['id_user'];
$file = $_FILES['foto'];

$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$allowed = ['jpg', 'jpeg', 'png'];

if (!in_array($ext, $allowed)) {
    die("Format tidak didukung");
}

$filename = "user_" . $id_user . "." . $ext;
$uploadDir = "../assets/image/profile/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$path = $uploadDir . $filename;

if (!move_uploaded_file($file['tmp_name'], $path)) {
    die("Gagal upload file");
}

$stmt = $conn->prepare("UPDATE users SET foto=? WHERE id=?");
$stmt->bind_param("si", $filename, $id_user);
$stmt->execute();

header("Location: ../pages/profile.php");
exit;
