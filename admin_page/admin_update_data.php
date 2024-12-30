<?php
session_start();

include '../koneksi2.php';

// Ambil nilai 'username' dari parameter GET
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Menggunakan prepared statement untuk menghindari SQL injection
    $sql = "SELECT * FROM data_member WHERE username = ?";

    // Persiapkan prepared statement
    $stmt = $koneksi->prepare($sql);

    // Binding parameter ke prepared statement
    $stmt->bind_param("s", $username);

    // Jalankan prepared statement
    $stmt->execute();

    // Ambil hasil query
    $result = $stmt->get_result();

    // Ambil data sebagai array asosiatif
    $existingData = $result->fetch_assoc();

    // Tutup prepared statement
    $stmt->close();

    // Tutup koneksi database
    $koneksi->close();
} else {
    // Jika parameter GET 'username' tidak ditemukan, berikan pesan kesalahan atau arahkan pengguna ke halaman lain
    echo "Parameter 'username' tidak ditemukan";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE DETAIL</title>
    <link rel="stylesheet" href="../css/register.css">
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
    <H2>PROFILE DETAIL</H2>

    <!-- Formulir untuk pendaftaran keanggotaan -->
    <form action="update_data_member.php" method="POST" enctype="multipart/form-data">

    <label for="username">Username:</label>
    <input type="text" disabled name="username" value="<?php echo $existingData['username']; ?>">

    <label for="nama_member">Full Name:</label>
    <input type="text" name="nama_member" value="<?php echo $existingData['nama_member']; ?>" required>

    <label for="jenis_member">Membership Type:</label>
    <select name="jenis_member" required>
        <option value="Regular" <?php echo ($existingData['jenis_member'] == 'Regular') ? 'selected' : ''; ?>>Regular</option>
        <option value="Premium" <?php echo ($existingData['jenis_member'] == 'Premium') ? 'selected' : ''; ?>>Premium</option>
    </select>

    <label for="jenis_kelamin">Gender:</label>
    <select name="jenis_kelamin" required>
        <option value="Male" <?php echo ($existingData['jenis_kelamin'] == 'Male') ? 'selected' : ''; ?>>Male</option>
        <option value="Female" <?php echo ($existingData['jenis_kelamin'] == 'Female') ? 'selected' : ''; ?>>Female</option>
    </select>

    <label for="tgl_lahir">Date of Birth:</label>
    <input type="date" name="tgl_lahir" value="<?php echo $existingData['tgl_lahir']; ?>" required>

    <label for="alamat">Address:</label>
    <textarea name="alamat"><?php echo $existingData['alamat']; ?></textarea>

    <label for="gol_darah">Blood Type:</label>
    <select name="gol_darah" required>
        <option value="O" <?php echo ($existingData['gol_darah'] == 'O') ? 'selected' : ''; ?>>O</option>
        <option value="A" <?php echo ($existingData['gol_darah'] == 'A') ? 'selected' : ''; ?>>A</option>
        <option value="B" <?php echo ($existingData['gol_darah'] == 'B') ? 'selected' : ''; ?>>B</option>
        <option value="AB" <?php echo ($existingData['gol_darah'] == 'AB') ? 'selected' : ''; ?>>AB</option>
    </select>

    <label for="riwayat_pykt">Medical History:</label>
    <textarea name="riwayat_pykt" required><?php echo $existingData['riwayat_pykt']; ?></textarea>

    <label for="foto_profil">Profile Photo:</label>
    <input type="file" name="foto_profil" accept="image/*">

    <button type="submit">Update Profile</button>
</form>
    <!-- Tambahkan elemen atau styling sesuai kebutuhan -->
</body>

</html>
