<?php
session_start();
include "../config/database.php";

// علق على هذي السطور لو ما تبغى Login
// if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
//     header("Location: ../pages/login.php");
//     exit;
// }

// حذف ترانزاكشن
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi='$id'");
    header("Location: ../admin/transaksi.php");
    exit;
}

// جلب إحصائيات الترانزاكشن
$subtotal  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total) AS total FROM transaksi"))['total'] ?? 0;
$pending   = mysqli_num_rows(mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE status='pending'"));
$diproses  = mysqli_num_rows(mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE status='diproses'"));
$selesai   = mysqli_num_rows(mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE status='selesai'"));

// جلب جميع الترانزاكشن مع تفاصيلها
$query = "SELECT t.*, 
          GROUP_CONCAT(td.nama_obat SEPARATOR ', ') as obat_list,
          GROUP_CONCAT(CONCAT(td.nama_obat, ' (', td.qty, 'x)') SEPARATOR ', ') as detail_obat
          FROM transaksi t
          LEFT JOIN detail_transaksi td ON t.id_transaksi = td.id_transaksi
          GROUP BY t.id_transaksi
          ORDER BY t.id_transaksi DESC";
$data = mysqli_query($conn, $query);
?>