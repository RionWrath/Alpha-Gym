<?php  
session_start();

$user = $_SESSION['username'];
include "koneksi2.php";
$result = mysqli_query($koneksi, "SELECT * FROM data_akun WHERE username = '$user'");

$username = $_SESSION['username'];

$query = "SELECT *
    FROM data_akun a
    INNER JOIN data_member m ON a.username = m.username
    WHERE m.username = '$user'";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    echo "Error in executing query: " . mysqli_error($koneksi);
    exit();
}

$member = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/profile.css">
</head>
<body>

<header>
    <nav>
        <div class="container">
            <div class="company-logo">
                <h1>Alpha Gym</h1>
            </div>
            <div class="menu-item">
                <li><a href="index.html">Home</a></li>
                <li><a href="logout.php"L>Logout</a></li>
            </div>
        </div>
    </nav>
</header>

<div class="profile-container">
    <div class="profile-header">
        <?php
        include "koneksi.php";

        $query = "SELECT *
        FROM data_akun a
        INNER JOIN data_member m ON a.username = m.username
        WHERE m.username = '$user'";
        
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            echo "Error in executing query: " . mysqli_error($koneksi);
            exit();
        }

        // Check if there are rows
        if(mysqli_num_rows($result) > 0) {
            $userData = mysqli_fetch_assoc($result);

            echo "<h1>PROFILE</h1>";
            $lokasiFoto = $userData['foto'];
            $urlFoto = "http://localhost/alpha_gym/$lokasiFoto";
            echo "<h3><img src='$urlFoto' alt='Photo Empty' width='150' height='150'></h3>";
            echo "<h3>Full Name: {$userData['nama_member']}</h3>";
            echo "<h3>Gender: {$userData['jenis_kelamin']}</h3>";
            echo "<h3>Birth Date: {$userData['tgl_lahir']}</h3>";
            echo "<h3>Address: {$userData['alamat']}</h3>";
            echo "<h3>Blood Type: {$userData['gol_darah']}</h3>";
            echo "<h3>Medical History: {$userData['riwayat_pykt']}</h3>";
            echo "<a href='edit_data_member.php'>EDIT YOUR PROFILE</a>";

            echo "<h1>ACCOUNT</h1>";
            echo "<h3>Username: {$userData['username']}</h3>";
            echo "<h3>Email: {$userData['email']}</h3>";
            echo "<h3>Membership: {$userData['jenis_member']}</h3>";
            echo "<h3>Membership Status: {$userData['status']}</h3>";
            echo "<h3>Masa Membership: {$userData['expire']}</h3>";


        } else {
            echo "<h1>Account</h1>";
            echo "<h1>PROFILE</h1>";
            echo "<h3>YOUR PROFILE IS EMPTY</h3>";
            echo "<a href='register_data_member.php'>EDIT YOUR PROFILE</a>";;
        }
        ?>
    </div>
</div>

</body>
</html>
