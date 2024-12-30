<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login_user.php');
    exit();
}

include('../koneksi2.php');

// Mendapatkan id dari parameter URL
$id = $_GET['id'];

// Mendapatkan data anggota berdasarkan id
$query = "SELECT * FROM data_member WHERE id = $id";
$result = mysqli_query($koneksi, $query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    echo "Error in executing query: " . mysqli_error($koneksi);
    exit();
}

// Ambil data anggota
$row = mysqli_fetch_assoc($result);

// Tentukan jenis dan masa membership
$jenis_member = $row['jenis_member'];
$masa_membership = ($jenis_member == 'Regular') ? 30 : 365; // Sesuaikan dengan aturan yang diinginkan

// Hitung tanggal kedaluwarsa (expiry date)
$expire = date('Y-m-d', strtotime("+$masa_membership days"));

// Update data anggota dengan jenis dan tanggal kedaluwarsa baru
$updateQuery = "UPDATE data_member SET jenis_member = '$jenis_member', expire = '$expire', status = 'Confirmed' WHERE id = $id";
$updateResult = mysqli_query($koneksi, $updateQuery);

// Periksa apakah query update berhasil dieksekusi
if (!$updateResult) {
    echo "Error in updating query: " . mysqli_error($koneksi);
    exit();
}

// Redirect kembali ke halaman admin setelah konfirmasi
header('Location: admin_dashboard.php');
exit();
?>
