<?php

include('config.php');

//get id
$id = $_GET['id'];
$conn = $connect;

$sql = "DELETE FROM data_pegawai WHERE id_pegawai = '$id'";

if($conn->query($sql)) {
    header("location: data-Pegawai.php");
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>