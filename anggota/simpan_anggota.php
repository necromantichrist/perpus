<?php

include "../koneksi/koneksi.php";

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];

mysqli_query($conn,"INSERT INTO anggota (nama,alamat,no_hp)
VALUES ('$nama','$alamat','$no_hp')");

header("location:data_anggota.php");

?>