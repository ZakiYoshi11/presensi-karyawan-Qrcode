<?php

//include koneksi database
include('config.php');

// if (isset($_POST['submit'])) {
    $nama_jabatan = $_POST['nama_jabatan'];
    $kode_jabatan = $_POST['kode_jabatan'];
    $conn = $connect;


        // query Update
        $query = "UPDATE jabatan_pegawai SET nama_jabatan='$nama_jabatan' WHERE kode_jabatan='$kode_jabatan'";

        // Eksekusi query
        $update = mysqli_query($conn, $query);

        // melakukan pengecekan hasil eksekusi query
        if ($update) {
            header("location: data-jabatan.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
?>