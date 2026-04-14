<?php

include "../koneksi/koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];

mysqli_query($conn,"UPDATE anggota SET
nama='$nama',
alamat='$alamat',
no_hp='$no_hp'
WHERE id_anggota='$id'");

header("location:data_anggota.php");

?>