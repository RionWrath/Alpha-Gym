<?php
session_start();

// Validasi session dan hak akses user
if (!isset($_SESSION['username'])) {
    header('Location: login_user.php');
    exit();
}

include 'koneksi.php';
$koneksi = new Database();


$cekdir = is_dir("foto_profil");
if ($cekdir) {
    opendir("foto_profil");
} else {
    mkdir("foto_profil");
    chmod("foto_profil", 0755);
    opendir("foto_profil");
}
$lokasi_foto_profil = $_FILES['foto_profil']['tmp_name'];
$nama_foto_profil = $_FILES['foto_profil']['name'];
$dir_foto_profil = "foto_profil/$nama_foto_profil";
move_uploaded_file($lokasi_foto_profil, $dir_foto_profil);

// Mendapatkan data dari form
$username = $_SESSION['username'];
$namaMember = $_POST['nama_member'];
$jenisMember = $_POST['jenis_member'];
$jenisKelamin = $_POST['jenis_kelamin'];
$tanggalLahir = $_POST['tgl_lahir'];
$alamat = $_POST['alamat'];
$golDarah = $_POST['gol_darah'];
$riwayatPykt = $_POST['riwayat_pykt'];

// Status awal adalah "Pending"
$status = 'Pending';

// Tanggal kedaluwarsa default atau sesuai dengan kebutuhan
$expireDate = null;

// Insert data member ke database
$koneksi->tambah_data_member($username, $namaMember, $jenisMember, $jenisKelamin, $tanggalLahir, $alamat, $golDarah, $riwayatPykt, $dir_foto_profil, $status, $expireDate);

// Redirect ke halaman user atau halaman konfirmasi
header('location: profile_user.php');
?>
