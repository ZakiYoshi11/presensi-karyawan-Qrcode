<?php

include('config.php');

//get id
$id = $_GET['id'];
$conn = $connect;

$sql = "DELETE FROM jabatan_pegawai WHERE id_jabatan = '$id'";

if($conn->query($sql)) {
    header("location: data-jabatan.php");
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>