<?php
session_start();

/* jika akses langsung tanpa checkout */
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Berhasil</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,.1);
        }
        .box h2 {
            color: #2ecc71;
        }
        .box a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>🎉 Transaksi Berhasil!</h2>
    <p>Pesanan kamu berhasil dibuat.</p>
    <p>Silakan lakukan pembayaran sesuai metode yang dipilih.</p>

    <a href="home.php">Kembali ke Beranda</a>
</div>

</body>
</html>
