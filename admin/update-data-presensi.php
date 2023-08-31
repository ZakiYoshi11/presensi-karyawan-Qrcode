<?php
  
include('config.php');

$conn = $connect;
$id = $_GET['id'];
  
  $query = "SELECT keterangan_presensi.id_presensi, keterangan_presensi.status_kehadiran, keterangan_presensi.jam_masuk, keterangan_presensi.jam_pulang,
  keterangan_presensi.tanggal_presensi, data_pegawai.nama_pegawai, keterangan_presensi.id_pegawai, keterangan_presensi.status_kehadiran_pulang
  FROM keterangan_presensi JOIN data_pegawai ON keterangan_presensi.id_pegawai = data_pegawai.id_pegawai WHERE keterangan_presensi.id_presensi = '$id'" ;

  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Presensi Puskesmas Bangko Barat</title>

    <!--bootstrap css-->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- navigasi css-->
    <link rel="stylesheet" href="navbar.css" />

    <!-- text style -->
    <link rel="stylesheet" href="text-style.css">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya&family=Cormorant+Garamond&family=Eczar&family=
    Gentium+Plus&family=Libre+Baskerville&family=Libre+Franklin&family=Proza+Libre&family=Rubik&family=Taviraj&family=
    Trirong&family=Work+Sans&display=swap" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-nav-green">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <h4>Puskesmas Bangko Barat </h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link  text-dark" aria-current="page" href="dashboard.php">Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-dark" href="Data-pegawai.php">Data Pegawai</a> 
                    </li>
                    <li class="nav-item">
                        <b><a class="nav-link text-dark" href="data-presensi.php">Data Presensi</a></b> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="data-jabatan.php"> Tambah Jabatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="qr-code.php">Atur Jam Kerja</a>
                    </li>
                </ul>
                   <!-- Form Logout -->
                   <form class="d-flex">
                <a href="logout.php" class="btn btn-danger">Keluar <i class="fas fa-sign-out-alt"></i></a>
            </form>
            </div>
        </div>
    </nav>
  <!-- Membuat CRUD dengan menggunakan tabel data_pegawai -->
  <main class="container-xxl">
        <div class="container" style="margin-top: 80px">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header text-center">
                            <h1>Status Kehadiran </h1>
                        </div>
                        <div class="card-body">
                            <!-- Form input data pegawai -->
                            <form action="update-presensi.php" method="POST">
                            <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="id_pegawai" placeholder="" class="form-control"
                                        value="<?php echo $row['id_pegawai'] ?>" readonly>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Nama Pegawai</label>
                                    <input type="text" name="nama_pegawai" placeholder="" class="form-control"
                                        value="<?php echo $row['nama_pegawai'] ?>" readonly>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Tanggal Presensi</label>
                                    <input type="text" name="tanggal_presensi" placeholder="" class="form-control"
                                        value="<?php echo $row['tanggal_presensi'] ?>" readonly>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Jam Masuk</label>
                                    <input type="text" name="jam_masuk" placeholder="" class="form-control"
                                        value="<?php echo $row['jam_masuk'] ?>" readonly>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Jam Pulang</label>
                                    <input type="text" name="jam_pulang" placeholder="" class="form-control"
                                        value="<?php echo $row['jam_pulang'] ?>" readonly>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Kehadiran Masuk</label>
                                    <?php 
                                    $stts = "SELECT status_kehadiran FROM keterangan_presensi WHERE id_presensi = '$id'";
                                    $result = mysqli_query($connect, $stts);
                                    $data = mysqli_fetch_array($result);
                                    $status = $data['status_kehadiran'];
                                    ?>
                                    <select name="status_kehadiran" class="form-control">
                                        <option <?php if($status == 'Hadir'){echo "selected"; } ?> value="Hadir">
                                            Hadir</option>
                                        <option <?php if($status == 'Cepat Pulang'){echo "selected"; } ?> value="Cepat Pulang">Cepat Pulang
                                        </option>
                                        <option <?php if($status == 'Terlambat'){echo "selected"; } ?> value="Terlambat">Terlambat
                                        </option>
                                        <option <?php if($status == 'Tidak Hadir'){echo "selected"; } ?> value="Tidak Hadir">Tidak Hadir
                                        </option>
                                        <option <?php if($status == 'Izin'){echo "selected"; } ?> value="Izin">Izin
                                        </option>
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Kehadiran Pulang</label>
                                    <?php 
                                    $stts = "SELECT status_kehadiran_pulang FROM keterangan_presensi WHERE id_presensi = '$id'";
                                    $result = mysqli_query($connect, $stts);
                                    $data = mysqli_fetch_array($result);
                                    $status = $data['status_kehadiran_pulang'];
                                    ?>
                                    <select name="status_kehadiran_pulang" class="form-control">
                                        <option <?php if($status == 'Hadir'){echo "selected"; } ?> value="Hadir">
                                            Hadir</option>
                                        <option <?php if($status == 'Cepat Pulang'){echo "selected"; } ?> value="Cepat Pulang">Cepat Pulang
                                        </option>
                                        <option <?php if($status == 'Terlambat'){echo "selected"; } ?> value="Terlambat">Terlambat
                                        </option>
                                        <option <?php if($status == 'Tidak Hadir'){echo "selected"; } ?> value="Tidak Hadir">Tidak Hadir
                                        </option>
                                        <option <?php if($status == 'Izin'){echo "selected"; } ?> value="Izin">Izin
                                        </option>
                                    </select>
                                </div>
                                   <!-- Button-->
                                   <div class="container">
                                   

                                    <!-- Button Left -->
                                    <div class="text-end mb-3">
                                        <button type="submit" class="btn btn-success" name="submit">EDIT</button>
                                        <a href="delete-presensi.php ?id=<?php echo $row['id_presensi']; ?>"
                                        class="btn btn-md btn-danger"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">HAPUS</a>
                                    </div>
                                </form>
                                 <!--Button Right -->
                                 <div class="text-start" style="margin-top: -50px;">
                                        <button type="submit" class="btn btn-danger" name="submit"><a
                                                class="text-light nav-link" href="Data-presensi.php">BACK</a></button>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>