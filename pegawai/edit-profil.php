<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Presensi Puskesmas Bangko Barat |</title>

    <!--bootstrap css-->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- navigasi css-->
    <link rel="stylesheet" href="navbar.css" />

    <!-- text style -->
    <link rel="stylesheet" href="text-style.css" />

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


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
                        <a class="nav-link active text-dark" aria-current="page" href="dashboard.php">Halaman Utama</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="presensi-pegawai.php">Presensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="info_presensi.php">Info Presensi</a>
                    </li>
                </ul>
                <a href="edit-profil.php" class="btn btn-primary m-2">
                    <i class="fas fa-user-edit"></i>Profil
                </a>
                <!-- Form Logout -->
                <form class="d-flex">
                    <a href="logout.php" class="btn btn-danger">Keluar <i class="fas fa-sign-out-alt"></i></a>
                </form>
            </div>
        </div>
    </nav>
    <main>
        <div class="container">
            <div class="card-deck mt-5">
                <?php
  // Koneksi ke database
  include 'config.php';
  $conn = $connect;
  // Menampilkan data QR Code hanya untuk pegawai yang melakukan login saja
  session_start();
  $username = $_SESSION['username'];
  $result = mysqli_query($conn, "SELECT data_pegawai.*, jabatan_pegawai.nama_jabatan FROM data_pegawai INNER JOIN jabatan_pegawai ON data_pegawai.id_jabatan=jabatan_pegawai.id_jabatan WHERE username='$username'");
  while ($row = mysqli_fetch_assoc($result)) {
  ?>
                <div class="card">
                    <div class="card-header bg-info text-white text-center">
                        <b> <h4> Profil</h4></b> 
                    </div>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td><b>ID Pegawai:</b></td>
                                <td><?php echo $row['id_pegawai']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Nama:</b></td>
                                <td><?php echo $row['nama_pegawai']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Jenis Kelamin:</b></td>
                                <td><?php echo $row['jenis_kelamin']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Jabatan:</b></td>
                                <td><?php echo $row['nama_jabatan']; ?></td>
                            </tr>
                            <tr>
                                <td><b>No HP:</b></td>
                                <td><?php echo $row['no_hp']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Alamat:</b></td>
                                <td><?php echo $row['alamat']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Username:</b></td>
                                <td><?php echo $row['username']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Email:</b></td>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-footer">
                        <div class="text-center mt-3">
                            <img src="../admin/QrCodePegawai/<?php echo $row['qrcode']; ?>"
                                class="img-responsive center-block" width="200" height="200">
                        </div>
                        <div class="text-center mt-3 mb-3">
                        <a href="../admin/QrCodePegawai/<?php echo $row['qrcode']; ?>" download><button type="button" class="btn btn-success">Download QR Code</button></a>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                    <a href="edit-profil-action.php?id=<?php echo $row['id_pegawai'] ?>"
                        class="btn btn-sm btn-primary">EDIT</a>
                    </div>
                </div>
                <?php
 }
 ?>
            </div>
        </div>

    </main>
    <script src="bootstrap/js/bootstrap.bundle.js">
    </script>
</body>

</html>