<?php
include "../config/database.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM contact WHERE id='$id'");

header("Location: admin_contact.php");
