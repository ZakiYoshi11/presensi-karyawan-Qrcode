<?php

//include koneksi database
include('config.php');

    $nama_pegawai = $_POST['nama_pegawai'];
    $id_pegawai = $_POST['id_pegawai'];
    $tanggal_presensi = $_POST['tanggal_presensi'];
    $status_kehadiran_masuk = $_POST['status_kehadiran'];
    $status_kehadiran_pulang = $_POST['status_kehadiran_pulang'];
    $id_presensi = $_GET['id'];
    $conn = $connect;

        // query Update
        $query = "UPDATE keterangan_presensi SET status_kehadiran='$status_kehadiran_masuk', 
        status_kehadiran_pulang='$status_kehadiran_pulang' WHERE id_pegawai ='$id_pegawai' AND tanggal_presensi = '$tanggal_presensi'";

        // Eksekusi query
        $update = mysqli_query($conn, $query);

        // melakukan pengecekan hasil eksekusi query
        if ($update) {
            header("location: data-presensi.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
//     }
// }
?>