<?php
session_start();
session_destroy();
header("Location: ../admin/data_obat.php");
?>
