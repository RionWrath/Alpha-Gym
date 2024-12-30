<?php
include "koneksi.php";
$db = new Database();

$username = $_POST['username'];
$password = $_POST['password'];

$login_success = false;

foreach ($db->login($username, $password) as $x) {
    session_start();
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $x['password'];
    $akses_id = $x['akses_id'];
    $pass = $x['password'];

    // Memeriksa user login sebagai admin atau peminjam
    if (($akses_id == '1') && ($password == $pass)) {
        $login_success = true;
        redirect('./admin_page/admin_dashboard.php');
    } elseif (($akses_id == '2') && ($password == $pass)) {
        $login_success = true;
        redirect('profile_user.php');
    }
}

// Jika login tidak berhasil, set variabel $error dan tetap di halaman login_user.php
$error = true;
redirect('login_user.php');

// Fungsi untuk pengalihan halaman dengan pesan kesalahan
function redirect($location, $error_message = null)
{
    if ($error_message) {
        $_SESSION['error_message'] = $error_message;
    }
    header("Location: $location");
    exit();
}
?>





