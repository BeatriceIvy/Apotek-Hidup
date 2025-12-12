<?php
include "../config/database.php"; // sesuaikan dengan koneksi kamu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = htmlspecialchars($_POST['nama']);
    $email  = htmlspecialchars($_POST['email']);
    $no_hp  = htmlspecialchars($_POST['no_hp']);
    $subjek = htmlspecialchars($_POST['subjek']);
    $pesan  = htmlspecialchars($_POST['pesan']);

    $status = "baru"; // default status pesan

    $query = "INSERT INTO contact 
              (nama, email, no_hp, subjek, pesan, status)
              VALUES 
              ('$nama','$email','$no_hp','$subjek','$pesan','$status')";

    if ($conn->query($query)) {
        echo "<script>
              alert('Pesan berhasil dikirim!');
              window.location.href='../pages/contact.php';
              </script>";
    } else {
        echo "Gagal mengirim pesan: " . $conn->error;
    }
}
?>
