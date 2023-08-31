<?php
// include 'config.php';
// session_start();

// $username = isset($_POST['username']);
// $password = isset($_POST['password']);
// if (isset($_COOKIE['id_user']) && isset($_COOKIE['key'])) {
//     $id_user = $_COOKIE['id_user'];
//     $key = $_COOKIE['key'];

//     //mengambil username dari database
//     $result = mysqli_query($connect, "SELECT username FROM tbadmin WHERE id_user = '$id_user'");
//     $row = mysqli_fetch_assoc($result);

//     // melakukan pengecekan terhadap username
//     if ($key == hash('sha256', $row['username'])) {
//         $_SESSION['username'] = true;
//     }
// }
// if (isset($_SESSION['username'])) {
//     header("Location: dashboard.php");
//     exit;
// }
// // melakukan proses pengecekan data users agar dapat melakukan proses login
// if (isset($_POST['submit'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     $conn = $connect;

//     $sql = "SELECT * FROM tbadmin WHERE tbadmin.username ='$username' AND tbadmin.password = '$password'";
//     $result = mysqli_query($conn, $sql);
//     $cek = mysqli_num_rows($result);

//     if ($cek > 0) {
//         $row = mysqli_fetch_assoc($result);
//         $_SESSION['username'] = $row['username'];
//         //cek remember me
//         if (isset($_POST["member"])) {
//             //buat coookie
//             //setcookie('login', 'true', time()+ 60);
//             setcookie('id_user', $row['id_user'], time() + 1);
//             setcookie('key', hash('sha256', $row['username']), time() + 1);
//         }
//         header("Location: index.php");
//     } else {
//         echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
//     }
// }
include 'config.php';
session_start();

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? md5($_POST['password']) : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';

if (isset($_COOKIE['id_user']) && isset($_COOKIE['key'])) {
    $id_user = $_COOKIE['id_user'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($connect, "SELECT username, status FROM data_pegawai WHERE id_user = '$id_user'");
    $row = mysqli_fetch_assoc($result);

    if ($key == hash('sha256', $row['username'] . $row['status'])) {
        $_SESSION['username'] = true;
    }
}

if (isset($_SESSION['username'])) {
    if ($row['status'] == 'admin') {
        header("Location: dashboard.php");
    } else {
        header("Location: pegawai.php");
    }
    exit;
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $status = $_POST['status'];

    $sql = "SELECT * FROM data_pegawai WHERE data_pegawai.username ='$username' AND data_pegawai.password = '$password' AND data_pegawai.status = '$status'";
    $result = mysqli_query($connect, $sql);
    $cek = mysqli_num_rows($result);

    if ($cek > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];

        if (isset($_POST["member"])) {
            setcookie('id_user', $row['id_user'], time() + 1);
            setcookie('key', hash('sha256', $row['username'] . $row['status']), time() + 1);
        }

        if ($row['status'] == 'Admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: pegawai/dashboard.php");
        }
    } else {
        echo "<script>alert('Data yang anda inputkan tidak sesuai. Silahkan coba lagi!')</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Presensi Puskesmas Bangko Barat</title>

    <!--bootstrap css-->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- my css-->
    <link rel="stylesheet" href="index.css" />

    <!-- text style -->
    <link rel="stylesheet" href="text-style.css">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya&family=Cormorant
    +Garamond&family=Eczar&family=Gentium+Plus&family=Libre+Baskerville&family=Libre
    +Franklin&family=Proza+Libre&family=Rubik&family=Taviraj&family=Trirong&family=Work+Sans&display=swap" rel="stylesheet">

</head>

<body class="index_body">
    <section id="home" class="hero">
        <div class="container">
            <div class="container">
                <div class="row">
                    <!-- continer right image-->
                    <div class="col-md-6 d-none d-md-block padding_login_right">
                        <div class="col-sm-12 ">
                            <img src="tool/Image_login/login_1.png" class="img-fluid" alt="login_1">
                        </div>
                    </div>
                    <!-- Login Card start -->
                    <div class="col-md-6 padding_login_left">
                        <div class="card card-form ms-3 me-3 pb-4 shadow-sm p-3 mb-5 bg-body rounded">
                            <h1>
                                Presensi Puskesmas
                                <small>Bangko Barat</small>
                            </h1>
                            <!-- continer left image-->
                            <div class="container">
                                <form action="" method="POST">
                                    <!-- form username-->
                                    <div class="mb-3 mt-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="username" class="form-label">Username</label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="username" placeholder="username"
                                                    name="username" value="<?php echo $username; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- form password-->
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="password" class="form-label">Password</label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="password" placeholder="Password"
                                                    name="password" value="<?php echo $password ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class ="form-select">
                                        <option value="">Pilih Status</option>
                                        <option value="Pegawai" value="<?php echo $status ?>">Pegawai</option>
                                        <option value="Admin" value="<?php echo $status ?>">Admin</option>
                                    </select>
                                </div>
                                <hr>
                                    <!-- button-->
                                    <div class="container">
                                        <div class="mb-3 text-end">
                                            <button type="submit" class="btn btn-outline-success ps-5 pe-5"
                                                name="submit">Sign-in</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- bootstrap js-->
    <script src="bootstrap/js/bootstrap.bundle.js">
    </script>
</body>
</html>