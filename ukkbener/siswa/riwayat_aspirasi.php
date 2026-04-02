<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";
include "../template/header.php";
?>

<h4>📄 Riwayat Aspirasi</h4>

<table class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Balasan Admin</th> <!-- ⬅ TAMBAH DI SINI -->
        </tr>
    </thead>
    <tbody>
        <?php
        $nis = $_SESSION['nis'];
        $q = mysqli_query($koneksi, "
            SELECT a.*, k.ket_kategori 
            FROM input_aspirasi a
            JOIN kategori k ON a.id_kategori = k.id_kategori
            WHERE a.nis = '$nis'
            ORDER BY a.id_pelaporan DESC
        ");

        $no = 1;
        while($d = mysqli_fetch_assoc($q)){
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['ket_kategori']; ?></td>
                <td><?= $d['lokasi']; ?></td>
                <td><?= $d['ket']; ?></td>
                <td>
                    <select class="form-select form-select-sm" disabled>
                        <option value="Menunggu" <?= $d['status']=='Menunggu'?'selected':'' ?>>Menunggu</option>
                        <option value="Proses" <?= $d['status']=='Proses'?'selected':'' ?>>Proses</option>
                        <option value="Selesai" <?= $d['status']=='Selesai'?'selected':'' ?>>Selesai</option>
                    </select>
                </td>
                <td>
                    <?= !empty($d['balasan']) ? $d['balasan'] : 'Belum dibalas'; ?> <!-- ⬅ DI SINI -->
                </td>
            </tr>
        <?php } ?>

        <?php if(mysqli_num_rows($q) == 0){ ?>
            <tr>
                <td colspan="6" class="text-center">Belum ada aspirasi</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include "../template/footer.php"; ?>
