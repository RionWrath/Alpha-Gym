<?php
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login_user.php');
    exit();
}

// Sertakan file koneksi
include "../koneksi2.php";

// Ambil username dari sesi
$username = $_SESSION['username'];

// Query untuk mengambil semua data member
$query = "SELECT * FROM data_member";
$result = mysqli_query($koneksi, $query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Error in executing query: " . mysqli_error($koneksi));
}

// Ambil semua data member
$allMembers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Members</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<header>
        <nav>
            <div class="container">
                <div class="company-logo">
                    <h1>Alpha Gym Admin</h1>
                </div>
                <div class="menu-item">
                <li><a href="javascript:history.back()">Back</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                    
                </div>
            </div>
        </nav>
    </header>
    <h2>All Members</h2>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Full Name</th>
            <th>Membership</th>
            <th>Gender</th>
            <th>Birth Date</th>
            <th>Address</th>
            <th>Blood Type</th>
            <th>Photo</th>
            <th>Status</th>
            <th>Expire</th>
        </tr>
        
        <?php
        // Loop through all members and display data in the table
        foreach ($allMembers as $member) {
            echo "<tr>";
            echo "<td>" . $member['username'] . "</td>";
            echo "<td>" . $member['nama_member'] . "</td>";
            echo "<td>" . $member['jenis_member'] . "</td>";
            echo "<td>" . $member['jenis_kelamin'] . "</td>";
            echo "<td>" . $member['tgl_lahir'] . "</td>";
            echo "<td>" . $member['alamat'] . "</td>";
            echo "<td>" . $member['gol_darah'] . "</td>";
            // $photoPath = $member['foto'];
            // echo "<td><img src='$photoPath' alt='Profile Photo' style='width: 50px; height: 50px;'></td>";
            echo "<td>" . $member['foto'] . "</td>";
            echo "<td>" . $member['status'] . "</td>";
            echo "<td>" . $member['expire'] . "</td>";
            echo "<td><a href='admin_update_data.php?username=" . $member['username'] . "'>Edit</a></td>";
            echo "<td><a href='delete_member.php?delete=" . $member['username'] . "' onclick=\"return confirm('Are you sure you want to delete this member?');\">Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
