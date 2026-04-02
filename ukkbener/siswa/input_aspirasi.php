<?php
session_start();
include "../config/koneksi.php";
include "../template/header.php";

// Pastikan siswa sudah login
if (!isset($_SESSION['nis'])) {
    header("Location: ../login.php");
    exit;
}
?>

<h4>Input Aspirasi</h4>

<form action="simpan_aspirasi.php" method="post">

    <div class="mb-3">
        <label class="form-label">NIS</label>
        <!-- NIS ditampilkan tapi readonly -->
        <input type="text" name="nis_display" class="form-control" 
               value="<?= $_SESSION['nis']; ?>" readonly>
        <!-- NIS asli tetap dikirim ke backend -->
        <input type="hidden" name="nis" value="<?= $_SESSION['nis']; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="id_kategori" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM kategori");
            while ($data = mysqli_fetch_assoc($q)) {
                echo "<option value='{$data['id_kategori']}'>{$data['ket_kategori']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Lokasi</label>
        <input type="text" name="lokasi" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="ket" class="form-control" rows="4" required></textarea>
    </div>

<button type="submit" class="btn btn-primary">Input Aspirasi</button>

</form>

<?php include "../template/footer.php"; ?>
