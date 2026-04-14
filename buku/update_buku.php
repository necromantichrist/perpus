<?php

include "../koneksi/koneksi.php";

$id = $_POST['id'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];
$stok = $_POST['stok'];

mysqli_query($conn,"UPDATE buku SET
judul='$judul',
penulis='$penulis',
penerbit='$penerbit',
tahun='$tahun',
stok='$stok'
WHERE id_buku='$id'");

header("location:data_buku.php");

?>