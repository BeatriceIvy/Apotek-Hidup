<?php
include "../config/database.php";

$id = $_GET['id'];

// update status jadi dibaca
mysqli_query($conn, "UPDATE contact SET status='dibaca' WHERE id='$id'");

$data = mysqli_query($conn, "SELECT * FROM contact WHERE id='$id'");
$p = mysqli_fetch_assoc($data);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Detail Kontak - Apotek Hidup</title>
    <link rel="stylesheet" href="../assets/css/contact-detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="../assets/image/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<div class="detail-box">
<h2>Detail Pesan</h2>
    <p><b>Nama:</b> <?= $p['nama'] ?></p>
    <p><b>Email:</b> <?= $p['email'] ?></p>
    <p><b>No HP:</b> <?= $p['no_hp'] ?></p>
    <p><b>Subjek:</b> <?= $p['subjek'] ?></p>
    <p><b>Pesan:</b><br><?= $p['pesan'] ?></p>
    <a href="admin_contact.php" class="back-btn">⬅ Kembali</a>
</div>
