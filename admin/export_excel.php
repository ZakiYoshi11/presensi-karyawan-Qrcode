<?php

include('config.php');

$conn = $connect;

$query = "SELECT keterangan_presensi.id_presensi, 
keterangan_presensi.id_pegawai, data_pegawai.nama_pegawai,
 keterangan_presensi.tanggal_presensi, keterangan_presensi.jam_masuk, 
 keterangan_presensi.jam_pulang, keterangan_presensi.ket_izin , keterangan_presensi.status_kehadiran
 FROM keterangan_presensi JOIN data_pegawai ON keterangan_presensi.id_pegawai = data_pegawai.id_pegawai";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=DataPresensi.xls");

?>
<table border="1">
    <tr>
        <th>ID Presensi</th>
        <th>ID Pegawai</th>
        <th>Nama Pegawai</th>
        <th>Tanggal Presensi</th>
        <th>Presnsi Masuk</th>
        <th>Presensi Pulang</th>
        <th>Status Presensi</th>
        <th>Keterangan</th>
    </tr>
<?php
$no = 1;
while ($data = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $no++  . "</td>";
    echo "<td>" . $data['id_pegawai'] . "</td>";
    echo "<td>" . $data['nama_pegawai'] . "</td>";
    echo "<td>" . $data['tanggal_presensi'] . "</td>";
    echo "<td>" . $data['jam_masuk'] . "</td>";
    echo "<td>" . $data['jam_pulang'] . "</td>";
    echo "<td>" . $data['status_kehadiran'] . "</td>";
    echo "<td>" . $data['ket_izin'] . "</td>";
    echo "</tr>";
}

?>
</table>
<?php

mysqli_close($conn);

?>