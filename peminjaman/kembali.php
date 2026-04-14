<?php

include "../koneksi/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM peminjaman WHERE id_peminjaman='$id'");
$d = mysqli_fetch_array($data);

$id_buku = $d['id_buku'];

mysqli_query($conn,"UPDATE peminjaman SET status='dikembalikan' WHERE id_peminjaman='$id'");

mysqli_query($conn,"UPDATE buku SET stok = stok + 1 WHERE id_buku='$id_buku'");

header("location:data_peminjaman.php");

?>