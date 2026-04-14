<?php
include "../koneksi/koneksi.php";
?>

<h2>Data Peminjaman</h2>

<a href="tambah_peminjaman.php">Tambah Peminjaman</a>

<br><br>

<table border="1">

<tr>
<th>No</th>
<th>Anggota</th>
<th>Buku</th>
<th>Tanggal Pinjam</th>
<th>Tanggal Kembali</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php

$query = mysqli_query($conn,"
SELECT peminjaman.*, anggota.nama, buku.judul
FROM peminjaman
LEFT JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
LEFT JOIN buku ON peminjaman.id_buku = buku.id_buku
");

$no=1;

while($d=mysqli_fetch_array($query)){

?>

<tr>

<td><?php echo $no++; ?></td>
<td><?php echo $d['nama']; ?></td>
<td><?php echo $d['judul']; ?></td>
<td><?php echo $d['tanggal_pinjam']; ?></td>
<td><?php echo $d['tanggal_kembali']; ?></td>
<td>
<?php
if($d['status'] == "dipinjam"){

    $today = date("Y-m-d");

    if($d['tanggal_kembali'] < $today){

        $selisih = (strtotime($today) - strtotime($d['tanggal_kembali'])) / 86400;

        echo "<span style='color:red;'>Terlambat ($selisih hari)</span>";

    }else{
        echo "Dipinjam";
    }

}else{
    echo "Dikembalikan";
}
?>
</td>
<td>

<?php
if($d['status']=="dipinjam"){
?>

<a href="kembali.php?id=<?php echo $d['id_peminjaman']; ?>">Kembalikan</a>

<?php
}
?>

</td>

</tr>

<?php
}
?>

</table>