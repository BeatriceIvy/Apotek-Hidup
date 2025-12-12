<?php
include "../config/database.php";

$nama     = $_POST['nama'];
$email    = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$conn->query("INSERT INTO users (nama, email, password)
VALUES ('$nama', '$email', '$password')");

header("Location: ../pages/login.php");
?>
