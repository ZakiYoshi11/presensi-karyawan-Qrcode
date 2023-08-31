<?php

//include koneksi database
include('config.php');

if (isset($_POST['submit'])) {
    $id_pegawai = $_POST['id_pegawai'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $nama_jabatan = $_POST['nama_jabatan'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password_Real = $_POST['password'];
    $password = md5($password_Real);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $conn = $connect;

    if (empty($id_pegawai) || empty($nama_pegawai) || empty($jenis_kelamin) 
    || empty($nama_jabatan) || empty($no_hp) || empty($alamat) || empty($username) 
    || empty($email) || empty($password) ||empty($status)) {
        echo '<script type="text/javascript">';
        echo 'alert("Gagal Menambah Data Coba Lakukan Peninputan Ulang");';
        echo 'window.location.href = "tambah-data-pegawai.php";';
        echo '</script>';
    } else {
        //generate QR Code
        require 'phpqrcode/qrlib.php';
        $namaFile = $id_pegawai . ".png";
        $tempDir = "QrCodePegawai/";
        $codeContents = $id_pegawai;

        //Pilihan inputan
        $input_email = QR_ECLEVEL_L;
        $input_margin = 2;
        $input_size = 10;
        //Membuat QR Code
        QRcode::png($codeContents, $tempDir.$namaFile, $input_email, $input_size, $input_margin);

        //  Melakukan pengecekan terhadap id_pegawai dan tanggal presensi
        $cek_presensi = mysqli_query($conn, "SELECT * FROM data_pegawai WHERE  username ='$username'");
        $result_username = mysqli_num_rows($cek_presensi);

        $cek_idpegawai = mysqli_query($conn, "SELECT * FROM data_pegawai WHERE id_pegawai='$id_pegawai'  ");
        $result_id_pegawai = mysqli_num_rows($cek_idpegawai);

        if($result_username > 0){
                echo '<script type="text/javascript">';
                echo 'alert("Username telah terdaftar lakukan penginputan ulang");';
                echo 'window.location.href = "tambah-data-pegawai.php";';
                echo '</script>';
        }elseif($result_id_pegawai>0){
                echo '<script type="text/javascript">';
                echo 'alert("NIK telah terdaftar lakukan penginputan ulang");';
                echo 'window.location.href = "tambah-data-pegawai.php";';
                echo '</script>';
            }else{
                            // query Insert/input data kedalam tabel data_pegawai
                $sql = "INSERT INTO data_pegawai (id_pegawai, nama_pegawai, jenis_kelamin, id_jabatan, no_hp, alamat, username, email, password, status, qrcode) 
                VALUES ('$id_pegawai', '$nama_pegawai', '$jenis_kelamin','$nama_jabatan' , '$no_hp', '$alamat', '$username','$email','$password', '$status', '$namaFile' )";
                
                // Mengeksekusi perintah INSERT
                if ($conn->query($sql)) {
                    echo '<script type="text/javascript">';
                    echo 'alert("Berhasil Menambahkan data pegawai");';
                    echo 'window.location.href = "Data-Pegawai.php";';
                    echo '</script>';
                } else {
                    //melihat error yang terjado
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);

            }
    
        }
       
    }
}
?>