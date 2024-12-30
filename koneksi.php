<?php

class Database {
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "alpha_gym";
    var $koneksi = "";

    function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    function tampil_data() {
        $data = mysqli_query($this->koneksi, "SELECT a., b. FROM data_peminjam a INNER JOIN jenis_kelamin b ON b.kode_jk = a.jenis_kelamin");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function login($username)
    {
    $data = mysqli_query($this->koneksi, "SELECT * FROM data_akun WHERE username = '$username'");

    if (mysqli_num_rows($data) == 0) {
        echo "<b>Data user tidak ditemukan</b>";
        $hasil = [];
        header('location: login.php');
    } else {
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
    }

    return $hasil;
    }

    function tambah_user($email, $username, $password)
{
    $akses_id = 2; 
    mysqli_query($this->koneksi, "INSERT INTO data_akun VALUES ('', '$email', '$username', '$password','$akses_id')");
   
}

    function tambah_data_member($username, $nama_member, $jenis_member, $jenis_kelamin, $tgl_lahir, $alamat, $gol_darah, $riwayat_pykt, $foto, $status, $expire)
    {
    mysqli_query($this->koneksi, "INSERT INTO data_member VALUES ('','$username','$nama_member', '$jenis_member', '$jenis_kelamin', '$tgl_lahir', '$alamat', '$gol_darah', '$riwayat_pykt', '$foto', 'pending', '')");
}

function update_data_member($username, $nama_member, $jenis_member, $jenis_kelamin, $tgl_lahir, $alamat, $gol_darah, $riwayat_pykt, $foto, $status, $expire)
{
mysqli_query($this->koneksi, "UPDATE INTO data_member VALUES ('','$username','$nama_member', '$jenis_member', '$jenis_kelamin', '$tgl_lahir', '$alamat', '$gol_darah', '$riwayat_pykt', '$foto', 'pending', '')");
}

    function tampil_data_member()
    {
        $result = mysqli_query($this->koneksi, "SELECT a.*, m.*
                                                FROM data_akun a
                                                INNER JOIN data_member m ON a.username = m.username");
        while ($row = mysqli_fetch_array($result)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    public function hapus_data_member($username) {
        $delete_query = "DELETE FROM data_member WHERE username = ?";
        $stmt = $this->koneksi->prepare($delete_query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
    }
}


