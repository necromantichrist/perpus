<?php

include "../koneksi/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM anggota WHERE id_anggota='$id'");
$d = mysqli_fetch_array($data);

?>

<h2>Edit Anggota</h2>

<form action="update_anggota.php" method="POST">

<input type="hidden" name="id" value="<?php echo $d['id_anggota']; ?>">

Nama
<br>
<input type="text" name="nama" value="<?php echo $d['nama']; ?>">
<br><br>

Alamat
<br>
<textarea name="alamat"><?php echo $d['alamat']; ?></textarea>
<br><br>

No HP
<br>
<input type="text" name="no_hp" value="<?php echo $d['no_hp']; ?>">
<br><br>

<button type="submit">Update</button>

</form>