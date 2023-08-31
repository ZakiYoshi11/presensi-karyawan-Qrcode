<?php
session_start();
setcookie('id_user', '', time() -1);
setcookie('key', '', time() -1);
unset($_SESSION['username']);
session_destroy();
header("Location: http://localhost/presensi_puskesmas/index.php");
?>
