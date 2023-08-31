<?php
include 'config.php';
$conn = $connect;
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}

// if(isset($_SESSION['username'])) {
//     $username = $_SESSION['username'];
//     $query = "SELECT * FROM keterangan_presensi JOIN data_pegawai ON 
//     keterangan_presensi.id_pegawai = data_pegawai.id_pegawai WHERE username = '$username' AND id_presensi";
//     $result = mysqli_query($conn, $query);
//     $row = mysqli_fetch_assoc($result);
//     if(mysqli_num_rows($result) > 0) {
?>


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
                        <b><a class="nav-link text-dark" href="info_presensi.php">Info Presensi</a></b>
                    </li>
                </ul>
                <a href="edit-profil.php" class="btn btn-primary m-2">
                    <i class="fas fa-user-edit"></i> Profil
                </a>
                <!-- Form Logout -->
                <form class="d-flex">
                    <a href="logout.php" class="btn btn-danger">Keluar <i class="fas fa-sign-out-alt"></i></a>
                </form>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mt-5 mb-5">
            <div class="text-center">
                <b>
                    <h2>Data Presensi Pegawai</h2>
                </b>
                <hr>
            </div>
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">NO.</th>
                        <th scope="col">TANGGAL PRESENSI</th>
                        <th scope="col">JAM MASUK</th>
                        <th scope="col">JAM PULANG</th>
                        <th scope="col">KEHADIRAN MASUK</th>
                        <th scope="col">KEHADIRAN PULANG</th>
                        <th scope="col">KETERANGAN IZIN</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $username = $_SESSION['username'];
                    $query = mysqli_query($connect,"SELECT keterangan_presensi.id_presensi, keterangan_presensi.jam_masuk, 
                    keterangan_presensi.jam_pulang, keterangan_presensi.tanggal_presensi, keterangan_presensi.status_kehadiran,
                    keterangan_presensi.status_kehadiran_pulang, keterangan_presensi.ket_izin, data_pegawai.id_pegawai FROM keterangan_presensi 
                    JOIN data_pegawai ON keterangan_presensi.id_pegawai = data_pegawai.id_pegawai WHERE username = '$username'");

                    $no = 1;
                    while ($row = mysqli_fetch_array($query)) {

                        ?>
                <tbody>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['tanggal_presensi']; ?></td>
                        <td><?php echo $row['jam_masuk']; ?></td>
                        <td><?php echo $row['jam_pulang']; ?></td>
                        <td><?php echo $row['status_kehadiran']; ?></td>
                        <td><?php echo $row['status_kehadiran_pulang']; ?></td>
                        <td><?php echo $row['ket_izin']; ?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
</body>

</html>
<?php
//     } else {
//         echo '<script type="text/javascript">';
//         echo 'alert("Belum Dapat Masuk! Tidak Ada Data Presensi.");';
//         echo 'window.location.href = "dashboard.php";';
//         echo '</script>';
//     }
// }
?>
</main>
<script src="bootstrap/js/bootstrap.bundle.js">
</script>
</body>

</html>