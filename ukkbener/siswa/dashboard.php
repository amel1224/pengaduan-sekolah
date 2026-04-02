<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Pengaduan Sekolah</a>
        <div class="ms-auto">
            <a href="../logout.php" class="btn btn-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h4>Dashboard Siswa</h4>
            <p>Selamat datang, <strong>NIS: <?= $_SESSION['nis']; ?></strong></p>
            <p>Kelas: <strong><?= $_SESSION['kelas']; ?></strong></p>

            <hr>

            <a href="input_aspirasi.php" class="btn btn-success mb-2">Input Aspirasi</a>
            <a href="riwayat_aspirasi.php" class="btn btn-primary mb-2">Data Aspirasi</a>
        </div>
    </div>
</div>

</body>
</html>
