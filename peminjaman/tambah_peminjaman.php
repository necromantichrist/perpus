<?php
include "../koneksi/koneksi.php";
?>

<h2>Tambah Peminjaman</h2>

<form action="simpan_peminjaman.php" method="POST">

Anggota
<br>

<select name="id_anggota">

<?php

$anggota = mysqli_query($conn,"SELECT * FROM anggota");

while($a=mysqli_fetch_array($anggota)){

?>

<option value="<?php echo $a['id_anggota']; ?>">
<?php echo $a['nama']; ?>
</option>

<?php
}
?>

</select>

<br><br>

Buku
<br>

<select name="id_buku">

<?php

$buku = mysqli_query($conn,"SELECT * FROM buku WHERE stok > 0");

while($b=mysqli_fetch_array($buku)){

?>

<option value="<?php echo $b['id_buku']; ?>">
<?php echo $b['judul']; ?>
</option>

<?php
}
?>

</select>

<br><br>

Tanggal Pinjam
<br>
<input type="date" name="tanggal_pinjam">

<br><br>

Tanggal Kembali
<br>
<input type="date" name="tanggal_kembali">

<br><br>

<button type="submit">Simpan</button>

</form>