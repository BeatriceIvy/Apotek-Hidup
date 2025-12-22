<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Add Obat - Apotek Hidup</title>
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
  <div class="form-box">
    <h3>Tambah Obat</h3>

    <form action="../auth/proses_obat.php" method="POST" enctype="multipart/form-data">

      <div class="form-group">
        <label>Nama Obat</label>
        <input type="text" name="nama_obat">
      </div>

      <div class="form-group">
        <label>Kategori</label>
        <input type="text" name="kategori">
      </div>

      <div class="form-group">
        <label>Harga</label>
        <input type="number" name="harga">
      </div>

      <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok">
      </div>

      <div class="form-group">
        <label>Expired</label>
        <input type="date" name="expired">
      </div>

      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi"></textarea>
      </div>

      <div class="form-group">
        <label>Gambar</label>
        <input type="file" name="gambar">
      </div>

      <button class="form-submit">Simpan</button>
      <a href="data_obat.php"></a><button class="back-btn">Kembali</button></a>
    </form>
  </div>
</div>