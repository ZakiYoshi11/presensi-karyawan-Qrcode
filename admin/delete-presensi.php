<?php

include('config.php');

//get id
$id = $_GET['id'];
$conn = $connect;

$sql = "DELETE FROM keterangan_presensi WHERE id_presensi = '$id'";

if($conn->query($sql)) {
    header("location: data-presensi.php");
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>