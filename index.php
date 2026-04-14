<?php
include "koneksi/koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Perpustakaan</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Data Buku</h1>

<a href="tambah_buku.php">Tambah Buku</a>

<table border="1">
<tr>
<th>No</th>
<th>Judul</th>
<th>Penulis</th>
<th>Penerbit</th>
<th>Tahun</th>
<th>Stok</th>
<th>Aksi</th>
</tr>

<?php

$data = mysqli_query($conn,"SELECT * FROM buku");

$no = 1;

while($d = mysqli_fetch_array($data)){

?>

<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $d['judul']; ?></td>
<td><?php echo $d['penulis']; ?></td>
<td><?php echo $d['penerbit']; ?></td>
<td><?php echo $d['tahun']; ?></td>
<td><?php echo $d['stok']; ?></td>

<td>
<a href="hapus_buku.php?id=<?php echo $d['id_buku']; ?>">Hapus</a>
</td>

</tr>

<?php
}
?>

</table>

</body>
</html>