<!--- memproses logi dari index.php-->
<?php
include 'config.php';

$conn = $connect;
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}

// Query untuk mengambil total data pegawai
$query_pegawai = "SELECT COUNT(*) as total_pegawai FROM data_pegawai";
$result_pegawai = mysqli_query($conn, $query_pegawai);
$data_pegawai = mysqli_fetch_assoc($result_pegawai);

// Query untuk mengambil total data keterangan presensi
$query_presensi = "SELECT COUNT(*) as total_presensi FROM keterangan_presensi";
$result_presensi = mysqli_query($conn, $query_presensi);
$data_presensi = mysqli_fetch_assoc($result_presensi);

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
    <link rel="stylesheet" href="text-style.css">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya&family=Cormorant+Garamond&family=Eczar&family=
    Gentium+Plus&family=Libre+Baskerville&family=Libre+Franklin&family=Proza+Libre&family=Rubik&family=Taviraj&family=
    Trirong&family=Work+Sans&display=swap" rel="stylesheet">

    <!-- Include FullCalendar.js and ClockPicker.js library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
                        <b><a class="nav-link active text-dark" aria-current="page" href="dashboard.php">Halaman Utama</a> </b>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="Data-pegawai.php">Data Pegawai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="data-presensi.php">Data Presensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="data-jabatan.php"> Tambah Jabatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark " href="qr-code.php">Atur Jam Kerja</a>
                    </li>
                </ul>
                <!-- Form Logout -->
                <form class="d-flex">
                    <a href="logout.php" class="btn btn-danger">Keluar <i class="fas fa-sign-out-alt"></i></a>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div id='calendar'></div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="jam">Jam:</label>
                    <div class="input-group clockpicker" data-autoclose="true">
                        <input type="text" class="form-control" value="09:30">
                        <span class="input-group-addon">
                            <span class="fa fa-clock-o"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div id='calendar'></div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="jam">Jam:</label>
                        <div class="input-group clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" value="09:30" id="jam">
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultDate: new Date(),
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [{
                        title: 'Event 1',
                        start: '2020-06-01'
                    },
                    {
                        title: 'Event 2',
                        start: '2020-06-07',
                        end: '2020-06-10'
                    }
                ]
            });
        });

        $('.clockpicker').clockpicker();

        setInterval(function() {
            var jam = new Date();
            var jam_str = jam.toLocaleTimeString();
            $('#jam').val(jam_str);
        }, 1000);
        </script>
    </main>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Total Data Pegawai</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data_pegawai['total_pegawai']; ?></h5>
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Total Data Keterangan Presensi</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data_presensi['total_presensi']; ?></h5>
                            <i class="fa fa-calendar fa-5x"></i>
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