<?php
include "koneksi/koneksi.php";

// jumlah buku
$buku = mysqli_query($conn,"SELECT * FROM buku");
$total_buku = mysqli_num_rows($buku);

// jumlah anggota
$anggota = mysqli_query($conn,"SELECT * FROM anggota");
$total_anggota = mysqli_num_rows($anggota);

// jumlah peminjaman
$peminjaman = mysqli_query($conn,"SELECT * FROM peminjaman");
$total_peminjaman = mysqli_num_rows($peminjaman);

// buku yang sedang dipinjam
$dipinjam = mysqli_query($conn,"SELECT * FROM peminjaman WHERE status='dipinjam'");
$total_dipinjam = mysqli_num_rows($dipinjam);

// buku terlambat
$terlambat = mysqli_query($conn,"
SELECT peminjaman.*, anggota.nama, buku.judul
FROM peminjaman
LEFT JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
LEFT JOIN buku ON peminjaman.id_buku = buku.id_buku
WHERE tanggal_kembali < CURDATE() AND status='dipinjam'
");

// jatuh tempo
$hampir = mysqli_query($conn,"
SELECT peminjaman.*, anggota.nama, buku.judul
FROM peminjaman
LEFT JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
LEFT JOIN buku ON peminjaman.id_buku = buku.id_buku
WHERE tanggal_kembali BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY)
AND status='dipinjam'
");

// mengambil data peminjaman untuk grafik
$grafik = mysqli_query($conn,"
SELECT tanggal_pinjam, COUNT(*) as jumlah
FROM peminjaman
GROUP BY tanggal_pinjam
");

// menyiapkan data grafik
$tanggal = [];
$jumlah = [];

while($row = mysqli_fetch_assoc($grafik)){
$tanggal[] = $row['tanggal_pinjam'];
$jumlah[] = $row['jumlah'];
}

// buku paling sering dipinjam
$buku_populer = mysqli_query($conn,"
SELECT buku.judul, COUNT(peminjaman.id_buku) AS total
FROM peminjaman
LEFT JOIN buku ON peminjaman.id_buku = buku.id_buku
GROUP BY peminjaman.id_buku
ORDER BY total DESC
LIMIT 5
");
?>

<h1>Dashboard Perpustakaan</h1>

<hr>

<h3>Total Buku : <?php echo $total_buku; ?></h3>
<h3>Total Anggota : <?php echo $total_anggota; ?></h3>
<h3>Total Peminjaman : <?php echo $total_peminjaman; ?></h3>
<h3>Buku Sedang Dipinjam : <?php echo $total_dipinjam; ?></h3>
<h2>Top 5 Buku Paling Populer</h2>

<table border="1">

<tr>
<th>No</th>
<th>Judul Buku</th>
<th>Jumlah Dipinjam</th>
</tr>

<?php
$no = 1;

while($d = mysqli_fetch_array($buku_populer)){
?>

<tr>

<td><?php echo $no++; ?></td>
<td><?php echo $d['judul']; ?></td>
<td><?php echo $d['total']; ?></td>

</tr>

<?php } ?>

</table>
<h2>Buku Terlambat</h2>

<table border="1">
<tr>
<th>Nama Anggota</th>
<th>Buku</th>
<th>Tanggal Kembali</th>
<th>Status</th>
</tr>

<?php
while($d=mysqli_fetch_array($terlambat)){
?>

<tr>
<td><?php echo $d['nama']; ?></td>
<td><?php echo $d['judul']; ?></td>
<td><?php echo $d['tanggal_kembali']; ?></td>
<td style="color:red;">Terlambat</td>
</tr>

<?php } ?>
</table>
<h2>Hampir Jatuh Tempo</h2>

<table border="1">

<tr>
<th>Anggota</th>
<th>Buku</th>
<th>Tanggal Kembali</th>
<th>Status</th>
</tr>

<?php
while($d=mysqli_fetch_array($hampir)){
?>

<tr>

<td><?php echo $d['nama']; ?></td>
<td><?php echo $d['judul']; ?></td>
<td><?php echo $d['tanggal_kembali']; ?></td>
<td style="color:orange;">Segera Kembalikan</td>

</tr>

<?php } ?>

</table>

<h2>Grafik Peminjaman Buku</h2>

<canvas id="grafikPeminjaman" width="600" height="100"></canvas>

<hr>

<h2>Menu</h2>

<a href="buku/data_buku.php">📚 Data Buku</a>
<br><br>

<a href="anggota/data_anggota.php">👨‍🎓 Data Anggota</a>
<br><br>

<a href="peminjaman/data_peminjaman.php">📖 Data Peminjaman</a>
<br><br>

<a href="logout.php">🚪 Logout</a>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

var ctx = document.getElementById('grafikPeminjaman').getContext('2d');

var grafik = new Chart(ctx, {
type: 'bar',
data: {
labels: <?php echo json_encode($tanggal); ?>,
datasets: [{
label: 'Jumlah Peminjaman',
data: <?php echo json_encode($jumlah); ?>,
borderWidth: 1
}]
},
options: {
scales: {
y: {
beginAtZero: true
}
}
}
});

</script>