<?php

include 'config.php';

$conn = $connect;

session_start();

$username = $_SESSION['username'];
// $id_presensi = $_POST['id_presensi'];
$id_pegawai = $_POST['id_pegawai'];
date_default_timezone_set("Asia/Jakarta");

// Mengatur jam dan tanggal mengikuti zona asia/jakarta

if (!isset($jam_presensi)) {
  $jam_presensi = date("H:i:s");
}
if (!isset($tanggal_presensi)) {
    $tanggal_presensi = date('Y-m-d');
  }

 // Mendapatkan data info_waktu_presensi terbaru
 $query_presensi = mysqli_query($conn, "SELECT * FROM info_waktu_presensi ORDER BY id_info_presensi DESC LIMIT 1");
 $data_presensi = mysqli_fetch_array($query_presensi);
 $id_info_presensi = $data_presensi['id_info_presensi'];
 $info_tanggal_presensi = $data_presensi['info_Tanggal_presensi'];
 $info_jam_masuk = $data_presensi['info_jam_masuk'];
 $info_jam_pulang = $data_presensi['info_jam_pulang'];

//  Melakukan pengecekan terhadap id_pegawai dan tanggal presensi
$cek_presensi = mysqli_query($conn, "SELECT * FROM keterangan_presensi WHERE id_presensi AND tanggal_presensi");
$result_cekpresensi = mysqli_num_rows($cek_presensi);

// Mengecek presensi jam masuk
if($result_cekpresensi>0){

            echo '<script type="text/javascript">';
             echo 'alert("Telah Melakukan Presensi");';
             echo 'window.location.href = "presensi-pegawai.php";';
             echo '</script>';

} else {
    if ($jam_presensi <= $info_jam_masuk) {
        // Status CEPAT PULANG
        $cp = mysqli_query($conn, "INSERT INTO keterangan_presensi (tanggal_presensi, jam_masuk, id_pegawai, 
            id_info_presensi, status_kehadiran, status_kehadiran_pulang) VALUES ('$tanggal_presensi', '$jam_presensi', '$id_pegawai', '$id_info_presensi', 'Hadir','Cepat Pulang')");
        if ($cp) {
            echo '<script type="text/javascript">';
            echo 'alert("Berhasil Melakukan Presensi Jam Masuk Tepat Waktu");';
            echo 'window.location.href = "presensi-pegawai.php";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Presensi gagal" ");';
            echo 'window.location.href = "presensi-pegawai.php";';
            echo '</script>';
        }
    } elseif ($jam_presensi > $info_jam_masuk && $jam_presensi <= $info_jam_pulang) {
        // Status CEPAT PULANG
        $tl = mysqli_query($conn, "INSERT INTO keterangan_presensi (tanggal_presensi, jam_masuk, id_pegawai, 
        id_info_presensi, status_kehadiran, status_kehadiran_pulang) VALUES ('$tanggal_presensi', '$jam_presensi', '$id_pegawai', '$id_info_presensi', 'Terlambat','Cepat Pulang')");
        if ($tl) {
            echo '<script type="text/javascript">';
            echo 'alert("Berhasil Melakukan Presensi Jam Masuk Tepat Waktu");';
            echo 'window.location.href = "presensi-pegawai.php";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Presensi gagal" ");';
            echo 'window.location.href = "presensi-pegawai.php";';
            echo '</script>';
        }
    }elseif($cek_presensi<=$info_jam_pulang){
        // query Update
         $query = "UPDATE keterangan_presensi SET status_kehadiran='Hadir' WHERE id_presensi";
         // Eksekusi query
         $update = mysqli_query($conn, $query);
 
         // melakukan pengecekan hasil eksekusi query
         if ($update) {
             echo '<script type="text/javascript">';
             echo 'alert("Presensi Jam Masuk" ");';
             echo 'window.location.href = "presensi-pegawai.php";';
             echo '</script>';
         } else {
             echo '<script type="text/javascript">';
             echo 'alert("Presensi gagal" ");';
             echo 'window.location.href = "presensi-pegawai.php";';
             echo '</script>';
          }
    }else{
            echo '<script type="text/javascript">';
            echo 'alert("Presensi gagal" ");';
            echo 'window.location.href = "presensi-pegawai.php";';
            echo '</script>';
    }
}
        
   
?>