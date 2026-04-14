<?php
include "../koneksi/koneksi.php";
?>

<h2>Data Anggota</h2>

<a href="tambah_anggota.php">Tambah Anggota</a>

<br><br>

<table border="1">

<tr>
<th>No</th>
<th>Nama</th>
<th>Alamat</th>
<th>No HP</th>
<th>Aksi</th>
</tr>

<?php

$data = mysqli_query($conn,"SELECT * FROM anggota");
$no = 1;

while($d = mysqli_fetch_array($data)){

?>

<tr>

<td><?php echo $no++; ?></td>
<td><?php echo $d['nama']; ?></td>
<td><?php echo $d['alamat']; ?></td>
<td><?php echo $d['no_hp']; ?></td>

<td>

<a href="edit_anggota.php?id=<?php echo $d['id_anggota']; ?>">Edit</a>

<a href="hapus_anggota.php?id=<?php echo $d['id_anggota']; ?>">Hapus</a>

</td>

</tr>

<?php
}
?>

</table>