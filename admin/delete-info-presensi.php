<?php

include('config.php');

//get id
$id = $_GET['id'];
$conn = $connect;

$sql = "DELETE FROM info_waktu_presensi WHERE id_info_presensi = '$id'";
$delete = mysqli_query($conn, $sql);
if(!$delete) { 
    echo '<script type="text/javascript">';
    echo 'alert("Gagal menghapus data masih terhubung");';
    echo 'window.location.href = "qr-code.php";';
    echo '</script>';
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Berhasil Menghapus Info Jam Kerja");';
    echo 'window.location.href = "qr-code.php";';
    echo '</script>';
}

?>