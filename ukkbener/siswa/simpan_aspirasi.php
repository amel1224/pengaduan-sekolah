<?php
session_start();
include "../config/koneksi.php";

$nis         = $_POST['nis'];
$id_kategori = $_POST['id_kategori'];
$lokasi      = $_POST['lokasi'];
$ket         = $_POST['ket'];
$status      = "Menunggu";

$sql = "INSERT INTO input_aspirasi 
        (nis, id_kategori, lokasi, ket, status)
        VALUES 
        ('$nis', '$id_kategori', '$lokasi', '$ket', '$status')";

$query = mysqli_query($koneksi, $sql);

if ($query) {
    header("Location: riwayat_aspirasi.php?success=1");
} else {
    echo "Gagal menyimpan aspirasi<br>";
    echo mysqli_error($koneksi);
}