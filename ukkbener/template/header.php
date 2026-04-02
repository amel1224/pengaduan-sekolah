<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaduan Sarana Sekolah</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-primary mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <a href="<?= ($_SESSION['role'] == 'admin') ? '../admin/dashboard.php' : '../siswa/dashboard.php' ?>" class="text-white me-3"><-</a>

            
            <span class="navbar-brand">Pengaduan Sarana Sekolah</span>
        </div>
        <a href="../logout.php" class="btn btn-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container">
