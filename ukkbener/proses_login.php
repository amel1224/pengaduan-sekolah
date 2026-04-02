<?php
session_start();
include "config/koneksi.php";

$user = $_POST['user'];
$password = $_POST['password'];

// ==================
// LOGIN ADMIN
// ==================
$q_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$user'");
$admin   = mysqli_fetch_assoc($q_admin);

if ($admin && password_verify($password, $admin['password'])) {

    $_SESSION['role']     = "admin";
    $_SESSION['username'] = $admin['username'];

    header("Location: admin/dashboard.php");
    exit;
}

// ==================
// LOGIN SISWA
// ==================
$q_siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$user'");
$siswa   = mysqli_fetch_assoc($q_siswa);

if ($siswa && password_verify($password, $siswa['password'])) {

    $_SESSION['role'] = "siswa";
    $_SESSION['nis']  = $siswa['nis'];
    $_SESSION['kelas']= $siswa['kelas'];

    header("Location: siswa/dashboard.php");
    exit;
}

// ==================
// GAGAL LOGIN
// ==================
echo "<script>
    alert('Username / NIS atau Password salah!');
    window.location='login.php';
</script>";
exit;
?>
