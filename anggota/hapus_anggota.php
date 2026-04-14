<?php

include "../koneksi/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM anggota WHERE id_anggota='$id'");

header("location:data_anggota.php");

?>