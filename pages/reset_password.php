<?php
session_start();
if (!isset($_SESSION['reset_token'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="auth-card">
    <h2>Reset Password</h2>
    <p>Buat password baru untuk akunmu</p>

    <form action="../auth/reset_password_process.php" method="POST">
        <input type="password" name="password" placeholder="Password baru" required>
        <input type="password" name="confirm" placeholder="Ulangi password" required>
        <button type="submit">Simpan Password</button>
    </form>
</div>

</body>
</html>
