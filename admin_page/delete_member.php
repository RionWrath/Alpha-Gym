<?php
session_start();

// Sertakan file koneksi
include "../koneksi.php";
$koneksi = new Database();

// Handle Delete Request
if (isset($_GET['delete'])) {
    $delete_username = $_GET['delete'];

    // Call the hapus_data_member function to delete the member
    $koneksi->hapus_data_member($delete_username);

    // Redirect ke halaman ini setelah menghapus
    header('Location: tampil_data_member.php');
    exit();
}

// ... the rest of your existing code ...
?>
