<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Cart kosong");
}

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: ../pages/home.php");
    exit;
}

// USER LOGIN
$id_user = $_SESSION['id_user'];

// DATA FORM
$payment_method = $_POST['payment_method'];
$nama = $_POST['nama_penerima'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];

// HITUNG TOTAL
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['harga'] * $item['qty'];
}

// INSERT TRANSAKSI (LENGKAP)
$stmt = $conn->prepare("
  INSERT INTO transaksi 
  (id_user, nama_penerima, no_hp, alamat, total)
  VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param(
  "isssi",
  $id_user,
  $nama,
  $no_hp,
  $alamat,
  $total
);

$stmt->execute();

// 🔥 CEK ERROR WAJIB
if ($stmt->error) {
    die("ERROR INSERT TRANSAKSI: " . $stmt->error);
}

// 🔥 AMBIL ID SETELAH EXECUTE
$id_transaksi = $conn->insert_id;

if (!$id_transaksi) {
    die("ID TRANSAKSI GAGAL TERBENTUK");
}

$stmt_detail = $conn->prepare("
  INSERT INTO detail_transaksi
  (id_transaksi, id_obat, nama_obat, harga, qty, subtotal)
  VALUES (?, ?, ?, ?, ?, ?)
");

foreach ($_SESSION['cart'] as $item) {
    $subtotal = $item['harga'] * $item['qty'];

    $stmt_detail->bind_param(
        "iisiii",
        $id_transaksi,
        $item['id'],
        $item['nama'],
        $item['harga'],
        $item['qty'],
        $subtotal
    );

    $stmt_detail->execute();

    if ($stmt_detail->error) {
        die("ERROR DETAIL: " . $stmt_detail->error);
    }
}

// 🔥 KOSONGKAN CART SETELAH CHECKOUT BERHASIL
unset($_SESSION['cart']);

header("Location: ../pages/sukses.php");
exit;


