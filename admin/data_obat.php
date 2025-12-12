<?php include "../config/database.php"; ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Obat - Apotek Hidup</title>
  <link rel="stylesheet" href="../assets/css/admin_obat.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="icon" type="image/png" href="../assets/image/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
</head>

<div class="admin-container">
  <div class="admin-title">
    <h2>Data Obat</h2>
    <a href="tambah_obat.php" class="btn-primary samping">+ Tambah Obat</a>
    <a href="dashboard.php" class="btn-primary">Kembali</a>
  </div>


  <table class="admin-table">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Kategori</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Expired</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    $data = mysqli_query($conn, "SELECT * FROM obat ORDER BY id_obat DESC");
    while ($row = mysqli_fetch_assoc($data)) {
      ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_obat']; ?></td>
        <td><?= $row['kategori']; ?></td>
        <td>Rp <?= number_format($row['harga']); ?></td>
        <td><?= $row['stok']; ?></td>
        <td><?= $row['expired']; ?></td>
        <td><img src="../assets/image/<?= $row['gambar']; ?>"></td>
        <td>
          <a href="edit_obat.php?id=<?= $row['id_obat']; ?>" class="btn-edit">Edit</a>
          <a href="hapus_obat.php?id=<?= $row['id_obat']; ?>" class="btn-hapus"
            onclick="return confirm('Hapus data?')">Hapus</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>