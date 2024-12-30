<?php
session_start();

$username = $_SESSION['username'];

include('koneksi.php'); 
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE DETAIL</title>
    <link rel="stylesheet" href="./css/register.css">
   
</head>

<body>
<header>
        <nav>
            <div class="container">
                <div class="company-logo">
                    <h1>Alpha Gym</h1>
                </div>
                <div class="menu-item">
                    <li><a href="login_user.php">Login</a></li>
                    <li><a href="index.html">Home</a></li>
                </div>
            </div>
        </nav>
    </header>
    <H2>PROFILE DETAIL</H2>

    <!-- Formulir untuk pendaftaran keanggotaan -->
    <form action="simpan_data_member.php" method="post" enctype="multipart/form-data">


        <label for="username">Username:</label>
        <input type="text" disabled value="<?php echo $username; ?>" name="username" required>

        <label for="nama_member">Full Name:</label>
        <input type="text" name="nama_member" required>

        <label for="jenis_member">Membership Type:</label>
        <select name="jenis_member" required>
            <option value="Regular">Basic</option>
            <option value="Premium">Premium</option>
            
        </select>

        <label for="jenis_kelamin">Gender:</label>
        <select name="jenis_kelamin" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <!-- Tambahkan opsi lain sesuai kebutuhan -->
        </select>

        <label for="tgl_lahir">Date of Birth:</label>
        <input type="date" name="tgl_lahir" required>

        <label for="alamat">Address:</label>
        <textarea name="alamat" required></textarea>

        <label for="gol_darah">Blood Type:</label>
        <select name="gol_darah" required>
            <option value="O">O</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>

        <label for="riwayat_pykt">Medical History:</label>
        <textarea name="riwayat_pykt" required></textarea>

        <label for="foto_profil">Profile Photo:</label>
        <input type="file" name="foto_profil" accept="image/*" required>

        <button type="submit">Register</button>
    </form>

    <!-- Tambahkan elemen atau styling sesuai kebutuhan -->
</body>

</html>


