<?php
include "../koneksi/koneksi.php";
?>

<h2>Data Buku</h2>

<form method="GET">
<input type="text" name="cari" placeholder="Cari judul buku">
<button type="submit">Cari</button> <a href="data_buku.php">Reset</a>
</form>

<br>

<a href="tambah_buku.php">Tambah Buku</a>
<br><br>

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

if(isset($_GET['cari'])){

$cari = $_GET['cari'];

$data = mysqli_query($conn,"SELECT * FROM buku 
WHERE judul LIKE '%$cari%'");

}else{

$data = mysqli_query($conn,"SELECT * FROM buku");

}

$no=1;

while($d=mysqli_fetch_array($data)){

?>

<tr>

<td><?php echo $no++; ?></td>
<td><?php echo $d['judul']; ?></td>
<td><?php echo $d['penulis']; ?></td>
<td><?php echo $d['penerbit']; ?></td>
<td><?php echo $d['tahun']; ?></td>
<td><?php echo $d['stok']; ?></td>

<td>

<a href="edit_buku.php?id=<?php echo $d['id_buku']; ?>">Edit</a>

<a href="hapus_buku.php?id=<?php echo $d['id_buku']; ?>">Hapus</a>

</td>

</tr>

<?php
}
?>

</table>