<?php
session_start();
include "../config/database.php";

$login    = mysqli_real_escape_string($conn, $_POST['login']);
$password = $_POST['password'];

$query = $conn->query("
    SELECT * FROM users 
    WHERE nama = '$login' OR email = '$login'
    LIMIT 1
");

$user = $query->fetch_assoc();

if ($user) {
    if (password_verify($password, $user['password'])) {

        $_SESSION['login']    = true;
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['email']    = $user['email'];
        $_SESSION['role']     = $user['role']; // 🔥 PENTING

        // 🔥 AUTO BEDAKAN ADMIN & USER
        if ($user['role'] == 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../pages/home.php");
        }
        exit;

    } else {
        header("Location: ../pages/login.php?error=password");
        exit;
    }
} else {
    header("Location: ../pages/login.php?error=notfound");
    exit;
}
?>
