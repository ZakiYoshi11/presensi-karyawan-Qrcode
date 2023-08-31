<?php

include 'config.php';

$conn = $connect;

session_start();

$username = $_SESSION['username'];
$id_pegawai = $_POST['id_pegawai'];
date_default_timezone_set("Asia/Jakarta");

if (!isset($jam_masuk)) {
  $jam_masuk = date("H:i:s");
}

if (!isset($jam_pulang)) {
  $jam_pulang = date("H:i:s");
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
 
$query_idpegawai = mysqli_query($conn, "SELECT * FROM keterangan_presensi ORDER BY id_pegawai DESC LIMIT 1");
$data_ketpresensi = mysqli_fetch_array($query_idpegawai);
$id_pegawai_select = $data_ketpresensi['id_pegawai'];

//  Melakukan pengecekan terhadap id_pegawai dan tanggal presensi
$cek_presensi = mysqli_query($conn, "SELECT * FROM keterangan_presensi WHERE id_presensi AND tanggal_presensi");
$result_cekpresensi = mysqli_num_rows($cek_presensi);



// Mendeteksi username
if ($username != $_SESSION['username']) {
  echo '<script type="text/javascript">';
        echo 'alert("Presensi Gagal! Username tidak sesuai.");';
        echo 'window.location.href = "presensi-pegawai.php";';
        echo '</script>';
} else {

  // Mendeteksi id_pegawai
  if ($id_pegawai != $_POST['id_pegawai']) {
    echo '<script type="text/javascript">';
    echo 'alert("Mohon Maaf Kode Pegawai Tidak sesuai");';
    echo 'window.location.href = "presensi-pegawai.php";';
    echo '</script>';
    // Cek Id_pegawai
  } else {
    
    // Mengecek presensi jam masuk
    if($result_cekpresensi>0){
      // Cek Tanggal Presensi
      if ($tanggal_presensi == $info_tanggal_presensi) {

        // Cek Jam Pulang
        if ($jam_pulang > $info_jam_masuk && $jam_pulang <= $info_jam_pulang) {

          mysqli_query($conn, " UPDATE keterangan_presensi SET jam_pulang ='$jam_pulang',
          status_kehadiran_pulang = 'Hadir' WHERE id_presensi");
          echo '<script type="text/javascript">';
          echo 'alert("Kamu Berhasil Melakukan Presensi Pulang");';
          echo 'window.location.href = "presensi-pegawai.php";';
          echo '</script>';
        } else {
          echo '<script type="text/javascript">';
          echo 'alert("Berhasil melakukan Presensi masuk");';
          echo 'window.location.href = "presensi-pegawai.php";';
          echo '</script>';
        }
      } 
    } else {

      if ($tanggal_presensi != $info_tanggal_presensi) {
        echo '<script type="text/javascript">';
        echo 'alert("Libur/Waktu Presensi Belum Diatur Segera Lakukan Konfirmasi");';
        echo 'window.location.href = "presensi-pegawai.php";';
        echo '</script>';
      } else {

        if ($jam_masuk <= $info_jam_masuk) {
          // Input data presensi
          mysqli_query($conn, "INSERT INTO keterangan_presensi (tanggal_presensi, jam_masuk, id_pegawai, 
          id_info_presensi, status_kehadiran) VALUES ('$tanggal_presensi', '$jam_masuk', '$id_pegawai', '$id_info_presensi', 'Hadir')");
          echo '<script type="text/javascript">';
          echo 'alert("Kamu Berhasil Melakukan Presensi Masuk");';
          echo 'window.location.href = "presensi-pegawai.php";';
          echo '</script>';
          // echo " $info_tanggal_presensi";     
        } else {
          if($jam_masuk > $info_jam_masuk){
            mysqli_query($conn, "INSERT INTO keterangan_presensi (tanggal_presensi, jam_masuk, id_pegawai, 
            id_info_presensi, status_kehadiran) VALUES ('$tanggal_presensi', '$jam_masuk', '$id_pegawai', '$id_info_presensi', 'Terlambat')");
                echo '<script type="text/javascript">';
                echo 'alert("Berhasil Melakukan Presensi Keterangan "TERLAMBAT" ");';
                echo 'window.location.href = "presensi-pegawai.php";';
                echo '</script>';
          }else{
            echo '<script type="text/javascript">';
                echo 'alert("Telah melakukan Presensi");';
                echo 'window.location.href = "presensi-pegawai.php";';
                echo '</script>';
          }
         

        }
      }
    }
  }
}
?>