<?php
session_start();
include "../config/database.php";

$email = trim($_POST['email']);

$user = $conn->query("SELECT id FROM users WHERE email='$email'")->fetch_assoc();

if (!$user) {
    die("Email tidak ditemukan");
}

// token simulasi
$_SESSION['reset_token'] = bin2hex(random_bytes(16));
$_SESSION['reset_user']  = $user['id'];

header("Location: ../pages/reset_password.php");
exit;
