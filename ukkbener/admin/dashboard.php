<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
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
            <h4>Dashboard Admin</h4>
            <p>Selamat datang, <strong><?= $_SESSION['username']; ?></strong></p>

            <hr>

            <a href="kelola_siswa.php" class="btn btn-primary mb-2">Kelola Data Siswa</a>
            <a href="data_aspirasi.php" class="btn btn-success mb-2">Kelola Aspirasi</a>
        </div>
    </div>
</div>

</body>
</html>
