<?php
include 'koneksi.php';
$koneksi = new Database();
$koneksi ->tambah_user($_POST['email'], $_POST['username'],  $_POST['password']);
header('location:login_user.php')
?>