<!-- proses menampilkan data dari dari tabel 
data_pegawai yang terdapat di dalam database -->
<?php
 
// menghubungkan config.php dimana telah terhubung dengan database
include 'config.php';

$conn = $connect;

// mengambil data dari tabel data_pegawai
$jumlah_keterangan_presensi = mysqli_query($conn,"SELECT * FROM keterangan_presensi");
 
// menghitung jumlah dari tabel data_pegawai
$jumlah_presensi = mysqli_num_rows($jumlah_keterangan_presensi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Presensi Puskesmas Bangko Barat </title>

    <!--bootstrap css-->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- Navbar css-->
    <link rel="stylesheet" href="Navbar.css" />

    <!-- text style -->
    <link rel="stylesheet" href="text-style.css">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya&family=Cormorant
    +Garamond&family=Eczar&family=Gentium+Plus&family=Libre+Baskerville&family=Libre
    +Franklin&family=Proza+Libre&family=Rubik&family=Taviraj&family=Trirong&family=Work+Sans&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Navigasi -->
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
                        <b> <a class="nav-link text-dark" href="data-presensi.php">Data Presensi</a></b>
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

    <main class="container-xxl">
        <div class=" p-3 rounded">
            <div class="container" style="margin-top: 20px">
                <div class="row">
                    <div class="col-md-12 p-4 rounded">
                        <div class="container text-center" style="margin-bottom: 50px;">
                            <h1>Data Presensi Pegawai Puskesmas</h1>
                        </div>
                        <div class="card">
                            <!-- Button Untuk melakukan penambahan data presensi -->
                            <div class="card-body">
                                <!-- Button untuk export file excel -->
                                <div class="text-lg-end">
                                    <a href="export_excel.php" class="btn btn-success "
                                        style="margin-right: 10px;">Export to Excel</a>
                                </div>

                                <!-- menampilkan jumlah data pada tabel keterangan_presensi -->
                                <div class="card-header" style="margin-left: -10px;">
                                    <p> Jumlah Data Presensi :
                                        <b><?php echo $jumlah_presensi; ?></b>
                                    </p>

                                    <div class="table-responsive-xxl">
                                        <!-- membuat table dan menampilkan data dari tabel keterangan_presensi -->
                                        <table class="table table-bordered" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">NO.</th>
                                                    <th scope="col">NAMA PEGAWAI</th>
                                                    <th scope="col">TANGGAL PRESENSI</th>
                                                    <th scope="col">JAM MASUK</th>
                                                    <th scope="col">JAM PULANG</th>
                                                    <th scope="col">KEHADIRAN MASUK</th>
                                                    <th scope="col">KEHADIRAN KELUAR</th>
                                                    <th scope="col">KETERANGAN IZIN</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <hr>
                                                <form class="form-inline my-2 my-lg-0" role="search" method="post"
                                                    action="">
                                                    <input class="form-control mr-sm-2" type="search"
                                                        placeholder="Search" aria-label="Search" name="search">
                                                    <br>
                                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"
                                                        name="submit">Search</button>
                                                </form>
                                                <hr>

                                                <!-- proses pengambilan 
                                             data dari tabel keterangan_presensi -->
                                                <?php 
                                                include('config.php');
                                                if(isset($_POST['submit'])){
                                                    $search = $_POST['search'];
                                                    $query = mysqli_query($connect, "SELECT  keterangan_presensi.id_presensi, keterangan_presensi.id_pegawai, keterangan_presensi.tanggal_presensi, 
                                                    keterangan_presensi.jam_masuk, keterangan_presensi.jam_pulang, keterangan_presensi.status_kehadiran, keterangan_presensi.status_kehadiran_pulang,
                                                    keterangan_presensi.ket_izin, data_pegawai.nama_pegawai FROM keterangan_presensi JOIN data_pegawai 
                                                    ON keterangan_presensi.id_pegawai = data_pegawai.id_pegawai WHERE keterangan_presensi.id_pegawai 
                                                    LIKE '%$search%' OR keterangan_presensi.tanggal_presensi LIKE '%$search%' OR keterangan_presensi.jam_masuk 
                                                    LIKE '%$search%' OR keterangan_presensi.jam_pulang LIKE '%$search%' OR keterangan_presensi.status_kehadiran LIKE '%$search%' OR keterangan_presensi.status_kehadiran_pulang
                                                    LIKE '%$search%' OR keterangan_presensi.ket_izin LIKE '%$search%' OR data_pegawai.nama_pegawai 
                                                    LIKE '%$search%'");
                                                } else {
                                                    $query = mysqli_query($connect,"SELECT keterangan_presensi.id_presensi, keterangan_presensi.id_pegawai, keterangan_presensi.tanggal_presensi, 
                                                    keterangan_presensi.jam_masuk, keterangan_presensi.jam_pulang, keterangan_presensi.status_kehadiran, keterangan_presensi.status_kehadiran_pulang,
                                                    keterangan_presensi.ket_izin, data_pegawai.nama_pegawai FROM keterangan_presensi JOIN data_pegawai 
                                                    ON keterangan_presensi.id_pegawai = data_pegawai.id_pegawai");
                                                }
                                                    $no = 1;
                                                    while($row = mysqli_fetch_array($query)){
                                                ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $row ['nama_pegawai']; ?></td>
                                                    <td><?php echo $row ['tanggal_presensi']; ?></td>
                                                    <td><?php echo $row ['jam_masuk']; ?></td>
                                                    <td><?php echo $row ['jam_pulang']; ?></td>
                                                    <td><?php echo $row ['status_kehadiran']; ?></td>
                                                    <td><?php echo $row ['status_kehadiran_pulang']; ?></td>
                                                    <td><?php echo $row ['ket_izin']; ?></td>
                                                    <td>
                                                        <a href="update-data-presensi.php ?id=<?php echo $row['id_presensi']; ?>"
                                                            class="btn btn-md btn-primary">OLAH DATA</a>
                                                        
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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