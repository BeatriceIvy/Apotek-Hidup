<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["error" => "DATA KOSONG"]);
    exit;
}

$id    = $data['id'] ?? null;
$nama  = $data['nama'] ?? null;
$harga = isset($data['harga']) ? (int)$data['harga'] : 0;

if (!$id || !$nama || !$harga) {
    echo json_encode(["error" => "DATA TIDAK LENGKAP"]);
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty'] += 1;
} else {
    $_SESSION['cart'][$id] = [
        "id" => $id,
        "nama" => $nama,
        "harga" => $harga,
        "qty" => 1
    ];
}

echo json_encode([
    "success" => true,
    "cart" => $_SESSION['cart']
]);
