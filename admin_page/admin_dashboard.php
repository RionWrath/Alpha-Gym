<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login_user.php');
    exit();
}

include('../koneksi2.php');


$query = "SELECT * FROM data_member WHERE status = 'Pending'";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                    <li><a href="../logout.php">Logout</a></li>
                </div>
            </div>
        </nav>
    </header>
    <div class = "table-container">
    <h2>Membership Confirmation</h2>

   
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Full Name</th>
            <th>Membership Type</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['nama_member'] . "</td>";
            echo "<td>" . $row['jenis_member'] . "</td>";
            echo "<td><a href='konfirmasi_membership.php?id=" . $row['id'] . "'>Confirm</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    </div>

    <h2>MENU ADMIN</h2>
    <a class="" href="tampil_data_member.php">DATA MEMBER</a>
<table>

</table>
    
</body>

</html>
