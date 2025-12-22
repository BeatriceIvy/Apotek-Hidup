<?php
session_start();
require_once __DIR__ . "/../config/database.php";

// ambil pelanggan
$pelanggan = $conn->query("SELECT * FROM pelanggan ORDER BY nama");

// ambil obat
$obat = $conn->query("SELECT * FROM obat WHERE stok > 0 ORDER BY nama_obat");

// PROSES SIMPAN
if (isset($_POST['simpan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama_penerima = $_POST['nama_penerima'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    $total = 0;
    foreach ($_POST['qty'] as $i => $qty) {
        if ($qty > 0) {
            $total += $_POST['harga'][$i] * $qty;
        }
    }

    // insert transaksi
    $stmt = $conn->prepare("
        INSERT INTO transaksi 
        (id_pelanggan, nama_penerima, no_hp, alamat, total, status)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "isssis",
        $id_pelanggan,
        $nama_penerima,
        $no_hp,
        $alamat,
        $total,
        $status
    );
    $stmt->execute();
    $id_transaksi = $stmt->insert_id;

    // insert detail
    foreach ($_POST['qty'] as $i => $qty) {
        if ($qty > 0) {
            $id_obat = $_POST['id_obat'][$i];
            $nama = $_POST['nama_obat'][$i];
            $harga = $_POST['harga'][$i];
            $subtotal = $harga * $qty;

            $conn->query("
                INSERT INTO transaksi_detail
                (id_transaksi, id_obat, nama_obat, harga, qty, subtotal)
                VALUES
                ($id_transaksi, $id_obat, '$nama', $harga, $qty, $subtotal)
            ");

            // kurangi stok
            $conn->query("
                UPDATE obat SET stok = stok - $qty
                WHERE id_obat = $id_obat
            ");
        }
    }

    echo "<script>alert('Transaksi berhasil ditambahkan');location='transaksi.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="../assets/css/tambah_transaksi.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/image/logo.png">
</head>

<body>

    <div class="form-container">

        <div class="form-header">
            <h2>Tambah Transaksi</h2>
            <a href="transaksi.php">← Kembali</a>
        </div>

        <form method="POST">

            <div class="form-grid">
                <div class="form-group">
                    <label>Pelanggan</label>
                    <select name="id_pelanggan" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php while ($p = $pelanggan->fetch_assoc()): ?>
                            <option value="<?= $p['id_pelanggan'] ?>">
                                <?= $p['nama'] ?> (<?= $p['no_hp'] ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="pending">Pending</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Penerima</label>
                    <input type="text" name="nama_penerima" required>
                </div>

                <div class="form-group">
                    <label>No HP</label>
                    <input type="text" name="no_hp" required>
                </div>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" rows="3" required></textarea>
            </div>

            <div class="table-wrapper">
                <h3>Daftar Obat</h3>
                <table>
                    <tr>
                        <th>Obat</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Qty</th>
                    </tr>

                    <?php while ($o = $obat->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <?= $o['nama_obat'] ?>
                                <input type="hidden" name="id_obat[]" value="<?= $o['id_obat'] ?>">
                                <input type="hidden" name="nama_obat[]" value="<?= $o['nama_obat'] ?>">
                            </td>
                            <td>
                                Rp <?= number_format($o['harga'], 0, ',', '.') ?>
                                <input type="hidden" name="harga[]" value="<?= $o['harga'] ?>">
                            </td>
                            <td><?= $o['stok'] ?></td>
                            <td>
                                <input type="number" name="qty[]" min="0" max="<?= $o['stok'] ?>" value="0">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>

            <div class="form-actions">
                <button type="submit" name="simpan" class="btn-primary">Simpan Transaksi</button>
                <a href="transaksi.php" class="btn-secondary">Batal</a>
            </div>

        </form>
    </div>


</body>

</html>