<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../pages/login.php");
    exit;
}

$id = $_SESSION['id_user'];
$nama = trim($_POST['nama']);
$email = trim($_POST['email']);

// update database
$stmt = $conn->prepare("
    UPDATE users 
    SET nama = ?, email = ? 
    WHERE id = ?
");
$stmt->bind_param("ssi", $nama, $email, $id);
$stmt->execute();

// update session biar langsung berubah
$_SESSION['nama'] = $nama;
$_SESSION['email'] = $email;

header("Location: ../pages/profile.php?success=1");
exit;
