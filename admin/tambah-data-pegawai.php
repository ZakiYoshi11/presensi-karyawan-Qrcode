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
                      <a class="nav-link text-dark" aria-current="page" href="dashboard.php">Halaman Utama</a>   
                    </li>
                    <li class="nav-item">
                    <b><a class="nav-link text-dark active" href="Data-pegawai.php">Data Pegawai</a></b>    
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="data-presensi.php">Data Presensi</a>
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
                            <h1>INPUT DATA PEGAWAI </h1>
                        </div>
                        <div class="card-body">
                            <!-- Form input data pegawai -->
                            <form action="tambah-pegawai.php" method="POST">
                                <div class="form-group">
                                    <label>Kode Pegawai</label>
                                    <input type="text" name="id_pegawai" placeholder="Masukkan NIK Pegawai"
                                        class="form-control">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_pegawai" placeholder="Masukkan Nama Pegawai"
                                        class="form-control">
                                </div>
                                <hr>
                                <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <br>
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="jenis_kelamin" value="Laki-laki">
                                    <label class="form-check-label" for="jenis_kelamin">
                                        Laki-Laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="jenis_kelamin" value="Perempuan">
                                    <label class="form-check-label" for="jenis_kelamin">
                                        Perempuan
                                    </label>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select name="nama_jabatan" class="form-select">

                                        <!-- Menampilkan Data Table Jabatan -->
                                        <option>Pilih jabatan</option>
                                        <?php 
                                    include('config.php');

                                    $conn = $connect;
                                     //Perintah sql untuk menampilkan semua data pada tabel jabatan
                                     $sql="select * from jabatan_pegawai";

                                        $hasil=mysqli_query($conn,$sql);
                                    while ($data = mysqli_fetch_array($hasil)) {
                                    ?>

                                        <option value="<?php echo $data['id_jabatan'];?>">
                                            <?php echo $data['nama_jabatan'];?>
                                        </option>
                                        <?php
                                    }
                                    ?>

                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Nomor Handphone</label>
                                    <input type="tel" name="no_hp" placeholder="Masukkan No Hp" class="form-control">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Pegawai"
                                        rows="4"></textarea>
                                </div>
                                <hr>
                                <div class="form-group text-center">
                                    <h3> <b>AKUN</b></h3>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" placeholder="Masukkan Username"
                                        class="form-control">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>email</label>
                                    <input type="email" name="email" placeholder="Masukkan Email"
                                        class="form-control">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class ="form-select">
                                        <option value="">Pilih Status</option>
                                        <option value="Pegawai">Pegawai</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" placeholder="Masukkan Password"
                                        class="form-control">
                                </div>
                                <hr>

                                <!-- Button-->
                                <div class="container">
                                    <!--Button Right -->
                                    

                                    <!-- Button Left -->
                                    <div class="text-end mb-3" >
                                        <button type="submit" class="btn btn-success" name="submit">SIMPAN</button>
                                        <button type="reset" class="btn btn-warning text-end ">RESET</button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-start" style="margin-top: -50px;">
                                        <button type="submit" class="btn btn-danger" name="submit"><a
                                                class="text-light nav-link" href="Data-pegawai.php">BACK</a></button>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="bootstrap/js/bootstrap.bundle.js">
    </script>
</body>

</html>