<!--- memproses logi dari index.php-->
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}

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
                        <b><a class="nav-link active text-dark" aria-current="page" href="dashboard.php">Halaman Utama</a></b>
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
                    <a href="logout.php" class="btn btn-danger">Logout <i class="fas fa-sign-out-alt"></i></a>
                </form>
            </div>
        </div>
    </nav>
    <script>
      function displayTime() {
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();
        var ampm = "AM";

        if (hours >= 12) {
          hours = hours - 12;
          ampm = "PM";
        }

        if (hours == 0) {
          hours = 12;
        }

        if (minutes < 10) {
          minutes = "0" + minutes;
        }

        if (seconds < 10) {
          seconds = "0" + seconds;
        }

        var clockTime = hours + ":" + minutes + ":" + seconds + " " + ampm;

        document.getElementById("clock").innerHTML = clockTime;
      }

      setInterval(displayTime, 1000);
    </script>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1 id="clock" class="display-1"></h1>
        </div>
      </div>
    </div>
    <div class="container text-center mt-5">
        <h2>Seputar Jam Kerja</h2>
    </div>
    <main class="container-xxl">
        <div class=" p-3 rounded">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 p-4 rounded">
                        <div class="card">
                            <!-- Button Untuk melakukan penambahan data pegawai -->
                            <div class="card-body">
                                <!-- menampilkan jumlah data pada tabel data_pegawai -->
                                <div class="card-header" style="margin-left: -10px;">
                                    <div class="table-responsive-xxl">
                                        <!-- membuat table dan menampilkan data dari tabel data_pegawai -->
                                        <table class="table table-bordered" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">INFO JAM MASUK</th>
                                                    <th scope="col">INFO JAM PULANG</th>
                                                    <th scope="col">INFO TANGGAL PRESENSI</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <hr>
                                                <!-- proses pengambilan 
                                                data dari tabel data_pegawai -->
                                                <?php 
                                                    include('config.php');
                                                            $query = mysqli_query($connect,"SELECT * FROM info_waktu_presensi ORDER BY 
                                                            id_info_presensi DESC LIMIT 1");
                                                        while($row = mysqli_fetch_array($query)){
                                                    ?>
                                                <tr>
                                                    
                                                    <td><?php echo $row['info_jam_masuk']; ?></td>
                                                    <td><?php echo $row['info_jam_pulang']; ?></td>
                                                    <td><?php echo $row['info_Tanggal_presensi']; ?></td>
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
    </main>

    <script src="bootstrap/js/bootstrap.bundle.js">
    </script>
</body>

</html>