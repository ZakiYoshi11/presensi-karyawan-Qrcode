<?php

//include koneksi database
include('config.php');

if (isset($_POST['submit'])) {
    $nama_jabatan = $_POST['nama_jabatan'];
    $kode_jabatan = $_POST['kode_jabatan'];
    $conn = $connect;

    if (empty($nama_jabatan)||empty($kode_jabatan)) {
        echo '<script type="text/javascript">';
        echo 'alert("Gagal Menambah Data Coba Lakukan Peninputan Ulang");';
        echo 'window.location.href = "tambah-data-jabatan.php";';
        echo '</script>';
    } else {
        // query Insert/input data kedalam tabel data_pegawai
        $sql = "INSERT INTO jabatan_pegawai (id_jabatan,kode_jabatan, nama_jabatan) 
        VALUES ('','$kode_jabatan', '$nama_jabatan')";
       
        // Mengeksekusi perintah INSERT
        if ($conn->query($sql)) {
            header("location: data-jabatan.php");
        } else {
            //melihat error yang terjado
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

        }
    }
}
?>