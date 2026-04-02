<?php
include "../config/koneksi.php";

$id      = $_POST['id'];
$balasan = mysqli_real_escape_string($koneksi, $_POST['balasan']);

mysqli_query($koneksi, "
    UPDATE input_aspirasi 
    SET balasan='$balasan' 
    WHERE id_pelaporan='$id'
");

header("Location: data_aspirasi.php");
