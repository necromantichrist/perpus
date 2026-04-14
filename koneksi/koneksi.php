<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "perpustakaan_db";

$conn = mysqli_connect($host,$user,$password,$database);

if(!$conn){
    echo "Koneksi gagal";
}

?>