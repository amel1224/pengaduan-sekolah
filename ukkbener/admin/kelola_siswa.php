<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";
include "../template/header.php";

// =====================
// HAPUS DATA
// =====================
if (isset($_GET['hapus'])) {
    $nis = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM siswa WHERE nis='$nis'");
    echo "<script>alert('Siswa dihapus');location='kelola_siswa.php';</script>";
}

// =====================
// TAMBAH DATA
// =====================
if (isset($_POST['tambah'])) {
    $nis   = $_POST['nis'];
    $nama  = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO siswa (nis, nama_siswa, kelas, password) VALUES (
        '$nis','$nama','$kelas','$pass'
    )");

    echo "<script>alert('Siswa ditambahkan');location='kelola_siswa.php';</script>";
}

// =====================
// EDIT DATA
// =====================
if (isset($_POST['edit'])) {
    $nis_lama = $_POST['nis_lama'];
    $nis      = $_POST['nis'];
    $nama     = $_POST['nama_siswa'];
    $kelas    = $_POST['kelas'];

    $sql = "UPDATE siswa SET 
            nis='$nis',
            nama_siswa='$nama',
            kelas='$kelas'";

    if (!empty($_POST['password'])) {
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql .= ", password='$pass'";
    }

    $sql .= " WHERE nis='$nis_lama'";
    mysqli_query($koneksi, $sql);

    echo "<script>alert('Data diperbarui');location='kelola_siswa.php';</script>";
}

// =====================
// AMBIL DATA
// =====================
$q = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
?>

<h4>Kelola Siswa</h4>

<form method="post" class="row g-2 mb-3">
    <div class="col">
        <input name="nis" class="form-control" placeholder="NIS" required>
    </div>
    <div class="col">
        <input name="nama_siswa" class="form-control" placeholder="Nama" required>
    </div>
    <div class="col">
        <input name="kelas" class="form-control" placeholder="Kelas" required>
    </div>
    <div class="col">
        <input name="password" type="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="col">
        <button name="tambah" class="btn btn-primary w-100">Tambah</button>
    </div>
</form>

<table class="table table-bordered">
    <tr class="table-primary">
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Aksi</th>
    </tr>

<?php $no=1; while($d=mysqli_fetch_assoc($q)){ ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['nis'] ?></td>
    <td><?= $d['nama_siswa'] ?></td>
    <td><?= $d['kelas'] ?></td>
    <td>
        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#e<?= $d['nis'] ?>">Edit</button>
        <a href="?hapus=<?= $d['nis'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
    </td>
</tr>

<!-- MODAL EDIT -->
<div class="modal fade" id="e<?= $d['nis'] ?>">
<div class="modal-dialog">
<div class="modal-content">
<form method="post">
    <div class="modal-body">
        <input type="hidden" name="nis_lama" value="<?= $d['nis'] ?>">
        <input name="nis" class="form-control mb-2" value="<?= $d['nis'] ?>">
        <input name="nama_siswa" class="form-control mb-2" value="<?= $d['nama_siswa'] ?>">
        <input name="kelas" class="form-control mb-2" value="<?= $d['kelas'] ?>">
        <input name="password" type="password" class="form-control" placeholder="Password baru (opsional)">
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button name="edit" class="btn btn-primary">Simpan</button>
    </div>
</form>
</div>
</div>
</div>
<?php } ?>
</table>

<?php include "../template/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
