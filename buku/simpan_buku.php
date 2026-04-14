<?php

include "../koneksi/koneksi.php";

$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];
$stok = $_POST['stok'];

$query = "INSERT INTO buku (judul, penulis, penerbit, tahun, stok)
VALUES ('$judul','$penulis','$penerbit','$tahun','$stok')";

mysqli_query($conn,$query);

header("location:data_buku.php");

?>