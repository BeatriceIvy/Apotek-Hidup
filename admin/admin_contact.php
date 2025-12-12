<?php
session_start();
include "../config/database.php";

$data = mysqli_query($conn, "SELECT * FROM contact ORDER BY id DESC");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kontak - Apotek Hidup</title>
    <link rel="stylesheet" href="../assets/css/admin-contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="../assets/image/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<div class="admin-container">
    <h2 class="admin-title">📩 Pesan Masuk</h2>

    <table class="contact-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Subjek</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['subjek'] ?></td>
                    <td>
                        <?php if ($row['status'] == 'baru'): ?>
                            <span class="status status-baru">Baru</span>
                        <?php else: ?>
                            <span class="status status-dibaca">Dibaca</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="contact_detail.php?id=<?= $row['id'] ?>" class="btn btn-detail">Detail</a>
                        <a href="contact_delete.php?id=<?= $row['id'] ?>" class="btn btn-delete"
                            onclick="return confirm('Yakin hapus pesan ini?')">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="back-btn">Kembali</a>
</div>