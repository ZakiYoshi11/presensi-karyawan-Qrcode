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
                    <a class="nav-link text-dark active" href="Data-pegawai.php">Data Pegawai</a>   
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
                            <h1>INPUT DATA JABATAN </h1>
                        </div>
                        <div class="card-body">
                            <!-- Form input data pegawai -->
                            <form action="tambah-jabatan.php" method="POST">
                                <div class="form-group">
                                    <label>Kode Jabatan</label>
                                    <input type="text" name="kode_jabatan" placeholder="Masukkan Kode Jabatan"
                                        class="form-control">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Nama Jabatan</label>
                                    <input type="text" name="nama_jabatan" placeholder="Masukkan Jabatan"
                                        class="form-control">
                                </div>
                                <hr>
                                <!-- Button-->
                                <div class="container">
                                   

                                    <!-- Button Left -->
                                    <div class="text-end mb-3">
                                        <button type="submit" class="btn btn-success" name="submit">SIMPAN</button>
                                        <button type="reset" class="btn btn-warning text-end ">RESET</button>
                                    </div>
                                </div>
                            </form>
                             <!--Button Right -->
                             <div class="text-start" style="margin-top: -50px;">
                                        <button type="submit" class="btn btn-danger" name="submit"><a
                                                class="text-light nav-link" href="data-jabatan.php">BACK</a></button>
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