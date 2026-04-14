<?php

include "../koneksi/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM buku WHERE id_buku='$id'");
$d = mysqli_fetch_array($data);

?>

<h2>Edit Buku</h2>

<form action="update_buku.php" method="POST">

<input type="hidden" name="id" value="<?php echo $d['id_buku']; ?>">

Judul
<br>
<input type="text" name="judul" value="<?php echo $d['judul']; ?>">
<br><br>

Penulis
<br>
<input type="text" name="penulis" value="<?php echo $d['penulis']; ?>">
<br><br>

Penerbit
<br>
<input type="text" name="penerbit" value="<?php echo $d['penerbit']; ?>">
<br><br>

Tahun
<br>
<input type="number" name="tahun" value="<?php echo $d['tahun']; ?>">
<br><br>

Stok
<br>
<input type="number" name="stok" value="<?php echo $d['stok']; ?>">
<br><br>

<button type="submit">Update</button>

</form>