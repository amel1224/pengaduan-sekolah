<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";
include "../template/header.php";

$where = "1=1";

if (!empty($_GET['keyword'])) {
    $k = mysqli_real_escape_string($koneksi, $_GET['keyword']);
    $where .= " AND (input_aspirasi.nis LIKE '%$k%' 
              OR siswa.kelas LIKE '%$k%' 
              OR input_aspirasi.lokasi LIKE '%$k%')";
}

if (!empty($_GET['kategori'])) {
    $idkat = $_GET['kategori'];
    $where .= " AND input_aspirasi.id_kategori='$idkat'";
}

$q = mysqli_query($koneksi, "
    SELECT input_aspirasi.*, siswa.kelas, kategori.ket_kategori
    FROM input_aspirasi
    JOIN siswa ON input_aspirasi.nis = siswa.nis
    JOIN kategori ON input_aspirasi.id_kategori = kategori.id_kategori
    WHERE $where
    ORDER BY input_aspirasi.id_pelaporan DESC
");
?>

<h4>Data Aspirasi Siswa</h4>

<!-- FORM SEARCH & FILTER -->
<form method="get" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="keyword" class="form-control"
               placeholder="Cari NIS / Kelas / Lokasi..."
               value="<?= $_GET['keyword'] ?? '' ?>">
    </div>

    <div class="col-md-4">
        <select name="kategori" class="form-select">
            <option value="">-- Semua Kategori --</option>
            <?php
            $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
            while($k = mysqli_fetch_assoc($kat)){
                $sel = ($_GET['kategori'] ?? '') == $k['id_kategori'] ? 'selected' : '';
                echo "<option value='$k[id_kategori]' $sel>$k[ket_kategori]</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">Cari</button>
    </div>

    <div class="col-md-2">
        <a href="data_aspirasi.php" class="btn btn-secondary w-100">Reset</a>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Tanggal</th>
            <th>Kelas</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Balasan</th>
        </tr>
    </thead>
<tbody>
<?php $no=1; while($d=mysqli_fetch_assoc($q)){ ?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= $d['nis'] ?></td>
  <td><?= date('d-m-Y H:i', strtotime($d['tgl_lapor'])) ?></td>
  <td><?= $d['kelas'] ?></td>
  <td><?= $d['ket_kategori'] ?></td>
  <td><?= $d['lokasi'] ?></td>
  <td><?= $d['ket'] ?></td>

  <td>
    <form action="update_status.php" method="post">
      <input type="hidden" name="id" value="<?= $d['id_pelaporan'] ?>">
      <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
        <option <?= $d['status']=='Menunggu'?'selected':'' ?>>Menunggu</option>
        <option <?= $d['status']=='Proses'?'selected':'' ?>>Proses</option>
        <option <?= $d['status']=='Selesai'?'selected':'' ?>>Selesai</option>
      </select>
    </form>
  </td>

  <td>
    <form action="balas.php" method="post">
      <input type="hidden" name="id" value="<?= $d['id_pelaporan'] ?>">
      <textarea name="balasan" class="form-control" rows="2"><?= $d['balasan'] ?></textarea>
      <button class="btn btn-sm btn-primary mt-1">Kirim</button>
    </form>
  </td>
</tr>
<?php } ?>
</tbody>
</table>

<?php include "../template/footer.php"; ?>
