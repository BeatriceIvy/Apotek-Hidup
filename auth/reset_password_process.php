<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['reset_user'])) {
    header("Location: login.php");
    exit;
}

$pass = $_POST['password'];
$confirm = $_POST['confirm'];

if ($pass !== $confirm) {
    die("Password tidak sama");
}

// HASH PASSWORD
$hash = password_hash($pass, PASSWORD_DEFAULT);

$id = $_SESSION['reset_user'];

$stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
$stmt->bind_param("si", $hash, $id);
$stmt->execute();

unset($_SESSION['reset_token']);
unset($_SESSION['reset_user']);

header("Location: ../pages/login.php?reset=success");
exit;
