<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Presensi Puskesmas Bangko Barat |</title>

    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- navigasi css -->
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"
        integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
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
                        <b><a class="nav-link text-dark" href="presensi-pegawai.php">Presensi</a></b>
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
    <main class="container">
        <div class="text-center pt-5">
            <h1><b> Scan Qr Code</b></h1>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 offset-md-3" id="reader"></div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3" id="result"></div>
        </div>

        <script>
        const scanner = new Html5QrcodeScanner('reader', {
            qrbox: {
                width: 250,
                height: 250,
            },
            fps: 20,
        });
        scanner.render(success, error);

        function success(result) {
            document.getElementById('result').innerHTML = `
            <form action="presensi-pegawai-scanning.php" method="POST" class = "">
            <div class="form-group">
                <label>Kode Pegawai</label>
                <input type="text" name="id_pegawai" value="${result}"class="form-control" readonly>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success" name="submit">PRESENSI</button>
            </div>
            </from>
            `;
            scanner.clear();

            // // Save scanned data to database
            // $.ajax({
            //     url: "presensi-pegawai-scanner.php",
            //     type: "POST",
            //     data: {
            //         id_pegawai: result
            //     },
            //     success: function(response) {
            //         console.log("Data saved successfully");
            //     },
            //     error: function(error) {
            //         console.error("Error saving data: " + error);
            //     }
            // });

        }

        function error(err) {
            console.error(err);
        }
        </script>
        <script src="bootstrap/js/bootstrap.bundle.js">
        </script>
    </main>
    <!-- Mengajukan IZIN -->
    <main class="container">
        <hr>
        <div class="container" style="margin-top: 80px">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header text-center">
                            <h1><b>Mengajukan Izin</b></h1>
                        </div>
                        <div class="card-body">
                            <!-- Form input data pegawai -->
                            <form action="izin.php" method="POST">
                                <!-- Button-->
                                <div class="container">
                                    <!-- Button Left -->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" name="submit">IZIN</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>

<!--==========================================================================================  -->