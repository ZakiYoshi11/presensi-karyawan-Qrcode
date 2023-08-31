<!-- proses menampilkan data dari dari tabel 
data_pegawai yang terdapat di dalam database -->
<?php
 
// menghubungkan config.php dimana telah terhubung dengan database
include 'config.php';

$conn = $connect;

// mengambil data dari tabel data_pegawai
$jumlah_data_pegawai = mysqli_query($conn,"SELECT * FROM data_pegawai");
 
// menghitung jumlah dari tabel data_pegawai
$jumlah_pegawai = mysqli_num_rows($jumlah_data_pegawai);
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
                        <b><a class="nav-link active text-dark" href="Data-pegawai.php">Data Pegawai</a></b>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="data-presensi.php">Data Presensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="data-jabatan.php"> Tambah Jabatan</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-dark" href="qr-code.php"> Atur Jam Kerja</a>
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
        <div class=" p-3 rounded">
            <div class="container" style="margin-top: 20px">
                <div class="row">
                    <div class="col-md-12 p-4 rounded">
                        <div class="container text-center" style="margin-bottom: 50px;">
                            <h1>Data Pegawai Puskesmas</h1>
                        </div>
                        <div class="card">
                            <!-- Button Untuk melakukan penambahan data pegawai -->
                            <div class="card-body">
                                <a href="tambah-data-pegawai.php" class="btn btn-md btn-success"
                                    style="margin-bottom: 12px">TAMBAH DATA</a>

                                <!-- menampilkan jumlah data pada tabel data_pegawai -->
                                <div class="card-header" style="margin-left: -10px;">
                                    <p> Jumlah Data Pegawai :
                                        <b><?php echo $jumlah_pegawai; ?></b>
                                    </p>
                                    <div class="table-responsive-xxl">
                                        <!-- membuat table dan menampilkan data dari tabel data_pegawai -->
                                        <table class="table table-bordered" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">NO.</th>
                                                    <th scope="col">NIK PEGAWAI</th>
                                                    <th scope="col">NAMA PEGAWAI</th>
                                                    <th scope="col">JENIS KELAMIN</th>
                                                    <th scope="col">JABATAN</th>
                                                    <th scope="col">NOMOR HANDPHONE</th>
                                                    <th scope="col">EMAIL</th>
                                                    <th scope="col">ALAMAT</th>
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
                                                 data dari tabel data_pegawai -->
                                                <?php 
                                                include('config.php');
                                                if(isset($_POST['submit'])){
                                                    $search = $_POST['search'];
                                                    $query = mysqli_query($connect, "SELECT data_pegawai.
                                                    id_pegawai, data_pegawai.nama_pegawai,  jabatan_pegawai.nama_jabatan, 
                                                    data_pegawai.no_hp, data_pegawai.alamat, data_pegawai.jenis_kelamin, 
                                                    data_pegawai.email FROM data_pegawai JOIN jabatan_pegawai ON 
                                                    data_pegawai.id_jabatan = jabatan_pegawai.id_jabatan WHERE data_pegawai.nama_pegawai 
                                                    LIKE '%$search%' OR data_pegawai.id_pegawai LIKE '%$search%' OR data_pegawai.jenis_kelamin 
                                                    LIKE '%$search%' OR jabatan_pegawai.nama_jabatan LIKE '%$search%' OR data_pegawai.no_hp 
                                                    LIKE '%$search%' OR data_pegawai.email LIKE '%$search%' OR data_pegawai.alamat LIKE 
                                                    '%$search%'");
                                                } else {
                                                    $query = mysqli_query($connect,"SELECT data_pegawai.id_pegawai, 
                                                    data_pegawai.nama_pegawai, jabatan_pegawai.nama_jabatan, data_pegawai.no_hp, 
                                                    data_pegawai.alamat, data_pegawai.jenis_kelamin, data_pegawai.email FROM data_pegawai 
                                                    JOIN jabatan_pegawai ON data_pegawai.id_jabatan = jabatan_pegawai.id_jabatan ");
                                                }
                                                    $no = 1;
                                                    while($row = mysqli_fetch_array($query)){
                                                        // Jika data yang dipilih adalah data paling atas, maka nomor urut akan bertambah
                                                        if(isset($_GET['id']) && $_GET['id'] == $row['id_pegawai']){
                                                            $no_selected = $no;
                                                        }

                                                ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $row['id_pegawai']; ?></td>
                                                    <td><?php echo $row['nama_pegawai']?></td>
                                                    <td><?php echo $row['jenis_kelamin']?></td>
                                                    <td><?php echo $row['nama_jabatan'] ?></td>
                                                    <td><?php echo $row['no_hp'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['alamat'] ?></td>
                                                    <!-- Button untuk melakukan proses Edit dan hapus data -->
                                                    <td class="text-center">
                                                        <a href="update-data-pegawai.php?id=<?php echo $row['id_pegawai'] ?>"
                                                            class="btn btn-sm btn-primary">OLAH DATA</a>
                                                    </td>
                                                </tr>
                                                <?php 
                                                } 
                                                ?>
                                            </tbody>
                                        </table>
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