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

 $query_ketpresensi = mysqli_query($conn, "SELECT * FROM keterangan_presensi ORDER BY id_presensi DESC LIMIT 1");
 $data_ketpresensi = mysqli_fetch_array($query_ketpresensi);
 $status_kehadiran_pulang = $data_ketpresensi['status_kehadiran_pulang'];



//  Melakukan pengecekan terhadap id_pegawai dan tanggal presensi
$cek_presensi = mysqli_query($conn, "SELECT * FROM keterangan_presensi WHERE id_pegawai = '$id_pegawai' AND tanggal_presensi = '$tanggal_presensi' ");
$result_cekpresensi = mysqli_num_rows($cek_presensi);

    // data realtime
	$jp = explode(':', $jam_presensi);
	$jm_presensi = $jp[0].$jp[1].$jp[2];

    $tp = explode('-', $tanggal_presensi);
	$tg_presensi = $tp[2].$tp[1].$tp[0];

    // data tabel keterangan presensi
    $ijm = explode(':', $info_jam_masuk);
	$ijm_masuk = $ijm[0].$ijm[1].$ijm[2];

	$ijp = explode(':', $info_jam_pulang);
	$ijm_pulang = $ijp[0].$ijp[1].$ijp[2];

    $itp = explode('-', $info_tanggal_presensi);
	$itg_presensi = $itp[2].$itp[1].$itp[0];


    if($result_cekpresensi>0){
        if($jm_presensi>$ijm_masuk && $jm_presensi <= $ijm_pulang && $tg_presensi==$itg_presensi && $status_kehadiran_pulang != 'Hadir' && $status_kehadiran_pulang != 'Izin' && $status_kehadiran != 'Izin'){
            // query Update
         $update = mysqli_query( $conn,"UPDATE keterangan_presensi SET jam_pulang = '$jm_presensi', status_kehadiran_pulang='Hadir' WHERE id_pegawai = '$id_pegawai' AND tanggal_presensi = '$tanggal_presensi'");
         // melakukan pengecekan hasil eksekusi query
         if ($update) {
                echo '<script type="text/javascript">';
                echo 'alert("Berhasil Melakukan Presensi Jam Pulang Tepat Waktu");';
                echo 'window.location.href = "presensi-pegawai.php";';
                echo '</script>';
         } else {
            echo '<script type="text/javascript">';
            echo 'alert("Gagal Melakukan Presensi Jam pulang");';
            echo 'window.location.href = "presensi-pegawai.php";';
            echo '</script>';
          }
        }elseif($jm_presensi > $ijm_pulang){
            echo '<script type="text/javascript">';
            echo 'alert("Jam atau Tanggal Presensi Tidak Sesuai");';
            echo 'window.location.href = "presensi-pegawai.php";';
            echo '</script>';
        }
        else{
            echo '<script type="text/javascript">';
            echo 'alert("Kamu Telah Melakukan Presensi Hari ini");';
            echo 'window.location.href = "presensi-pegawai.php";';
            echo '</script>';
        }
} else {

    if (($jm_presensi <= $ijm_masuk) && ($tg_presensi==$itg_presensi) ) {
        // Status CEPAT PULANG
        $cp = mysqli_query($conn, "INSERT INTO keterangan_presensi (tanggal_presensi, jam_masuk, id_pegawai, 
                id_info_presensi, status_kehadiran, status_kehadiran_pulang) VALUES ('$tanggal_presensi', '$jm_presensi', '$id_pegawai', '$id_info_presensi', 'Hadir','Cepat Pulang')");
        if ($cp) {
            echo '<script type="text/javascript">';
            echo 'alert("Berhasil Melakukan Presensi Jam Masuk Tepat Waktu");';
            echo 'window.location.href = "presensi-pegawai.php";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Gagal melakukan presensi masuk");';
            echo 'window.location.href = "presensi-pegawai.php";';
            echo '</script>';
        }

    } else if (($jm_presensi > $ijm_masuk && $jm_presensi<= $ijm_pulang)  && ($tg_presensi==$itg_presensi)) {
            // Status CEPAT PULANG
            $tl = mysqli_query($conn, "INSERT INTO keterangan_presensi (tanggal_presensi, jam_masuk, id_pegawai, 
            id_info_presensi, status_kehadiran, status_kehadiran_pulang) VALUES ('$tanggal_presensi', '$jm_presensi', '$id_pegawai', '$id_info_presensi', 'Terlambat','Cepat Pulang')");
            if ($tl) {
                echo '<script type="text/javascript">';
                echo 'alert("Berhasil melaukan Presensi masuk Terlambat");';
                echo 'window.location.href = "presensi-pegawai.php";';
                echo '</script>';
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("Gagal Melakukan Presensi Masuk");';
                echo 'window.location.href = "presensi-pegawai.php";';
                echo '</script>';
            }
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Tanggal Dan jam Presensi tidak sesuai");';
            echo 'window.location.href = "presensi-pegawai.php";';
            echo '</script>';
        }
    
}

?>