<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

$id     = $_POST['id'];
$status = $_POST['status'];

mysqli_query($koneksi, "UPDATE input_aspirasi SET status='$status' WHERE id_pelaporan='$id'");

header("Location: data_aspirasi.php");
exit;
