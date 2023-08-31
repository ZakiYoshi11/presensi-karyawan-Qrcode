<?php
//include koneksi database
include('config.php');

if (isset($_POST['submit'])) {
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];
    $tanggal_presensi = $_POST['tanggal_presensi'];
    $conn = $connect;

    if (empty($jam_masuk) || empty($jam_pulang) || empty($tanggal_presensi)) {
        echo '<script type="text/javascript">';
        echo 'alert("Gagal Menambah Data Coba Lakukan Penginputan Ulang");';
        echo 'window.location.href = "qr-code.php";';
        echo '</script>';
    } else {
        // query Insert/input data kedalam tabel data_pegawai
        $sql = "INSERT INTO info_waktu_presensi (info_jam_masuk, info_jam_pulang, info_tanggal_presensi)
    VALUES ('$jam_masuk', '$jam_pulang', '$tanggal_presensi')";

        // Mengeksekusi perintah INSERT
        if ($conn->query($sql)) {
            header("location: qr-code.php");
        } else {
            //melihat error yang terjadi
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

        }
    }
}

?>