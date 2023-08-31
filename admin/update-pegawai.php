<?php

//include koneksi database
include('config.php');

// if (isset($_POST['submit'])) {
    $id_pegawai = $_POST['id_pegawai'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $nama_jabatan = $_POST['nama_jabatan'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password_Real = $_POST['password'];
    $password = md5($password_Real);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $conn = $connect;

        // query Update
        $query = "UPDATE data_pegawai SET nama_pegawai='$nama_pegawai', jenis_kelamin='$jenis_kelamin',
 id_jabatan='$nama_jabatan', no_hp='$no_hp', alamat='$alamat', username='$username', 
 email='$email',status = '$status',password='$password' WHERE id_pegawai='$id_pegawai'";

        // Eksekusi query
        $update = mysqli_query($conn, $query);

        // melakukan pengecekan hasil eksekusi query
        if ($update) {
            header("location: data-pegawai.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
?>