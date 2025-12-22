<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="auth-card">
    <h2>Lupa Password</h2>
    <p>Masukkan email yang terdaftar</p>

    <form action="../auth/lupa_password_process.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Lanjutkan</button>
    </form>

    <a href="login.php">← Kembali ke Login</a>
</div>

</body>
</html>
