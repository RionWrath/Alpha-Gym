<?php
session_start();

// Validasi session dan hak akses user
if (!isset($_SESSION['username'])) {
    header('Location: login_user.php');
    exit();
}

include 'koneksi.php';
$koneksi = new Database();

// Mendapatkan data dari form
$username = $_SESSION['username'];
$namaMember = $_POST['nama_member'];
$jenisMember = $_POST['jenis_member'];
$jenisKelamin = $_POST['jenis_kelamin'];
$tanggalLahir = $_POST['tgl_lahir'];
$alamat = $_POST['alamat'];
$golDarah = $_POST['gol_darah'];
$riwayatPykt = $_POST['riwayat_pykt'];

// Validasi dan upload foto profil
$cekdir = is_dir("foto_profil");
if (!$cekdir) {
    mkdir("foto_profil", 0755, true);  // create directory if not exists
}

$lokasi_foto_profil = $_FILES['foto_profil']['tmp_name'];
$nama_foto_profil = $_FILES['foto_profil']['name'];
$dir_foto_profil = "foto_profil/$nama_foto_profil";
move_uploaded_file($lokasi_foto_profil, $dir_foto_profil);

// Perbarui data di tabel data_member
$query = "UPDATE data_member SET
                nama_member = ?,
                jenis_member = ?,
                jenis_kelamin = ?,
                tgl_lahir = ?,
                alamat = ?,
                gol_darah = ?,
                riwayat_pykt = ?,
                foto = ?
                WHERE username = ?";

// Persiapkan prepared statement
$stmt = $koneksi->koneksi->prepare($query);

// Binding parameter ke prepared statement
$stmt->bind_param("sssssssss", $namaMember, $jenisMember, $jenisKelamin, $tanggalLahir, $alamat, $golDarah, $riwayatPykt, $dir_foto_profil, $username);

// Eksekusi prepared statement
$stmt->execute();

// Tutup prepared statement
$stmt->close();

// Redirect ke halaman user atau halaman konfirmasi
header('location: profile_user.php');
?>
