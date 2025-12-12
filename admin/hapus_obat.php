<?php
include "../config/database.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM obat WHERE id_obat='$id'");

header("location:../admin/data_obat.php");
