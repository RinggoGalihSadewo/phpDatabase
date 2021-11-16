<?php 






session_start();

if ( !isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}
	
require 'functions.php';


// pagination
// konfigurasi
$jumlahDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

// if( isset($_GET["halaman"])){
// 	$halamanAktif = $_GET["halaman"];
// } 

// else {
// 	$halamanAktif = 1;
// }

// atau
$halamanAktif = ( isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

if(isset($_POST["cari"])){
	$mahasiswa = cari($_POST["keyword"]);
}

?>	

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
</head>
<body>

	<a href="logout.php">Logout</a>

	<h1>Daftar Mahasiswa</h1>

	<a href="tambah.php">Tambah Data Mahasiswa</a>
	<br><br>

	<form action="" method="POST">
		<input type="text" name="keyword" size="40" autofocus="" placeholder="Masukan keyword pencarian" autocomplete="off" id="keyword">
		<button type="submit" name="cari" id="tombol-cari">Cari</button>
	</form>

	<br>

	<!-- navigasi -->

	<?php if($halamanAktif>1): ?>
		<a href="?halaman=<?= $halamanAktif-1?>">&laquo;</a>
	<?php endif; ?>

	<?php for( $i = 1; $i <= $jumlahHalaman; $i++): ?>
		<?php if( $i==$halamanAktif): ?>
			<a href="?halaman=<?= $i;?>" style="font-weight: bold; color: red;"><?= $i?></a>
		<?php else : ?>
			<a href="?halaman=<?= $i;?>"><?= $i?></a>
		<?php endif; ?>
	<?php endfor; ?>

	<?php if($halamanAktif < $jumlahHalaman): ?>
		<a href="?halaman=<?= $halamanAktif+1?>">&raquo;</a>
	<?php endif; ?>

	<br><br>

	<div id="container">

	<table border='1' cellpadding="10" cellspacing="0">
		
		<tr>
			<th>No.</th>
			<th>Aksi</th>
			<th>Gambar</th>
			<th>NIM</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Jurasan</th>
		</tr>

		<?php $i=1; ?>
		<?php foreach( $mahasiswa as $row):?>
		
			<tr>
				<td><?= $i ?></td>
				<td>
					<a href="ubah.php?id=<?= $row["id"];?>">Ubah</a> |
					<a href="hapus.php?id=<?= $row["id"];?>" onclick="return contifrm('yakin?')">Hapus</a>
				</td>
				<td>
					<img src="img/<?= $row["gambar"] ?>" width="100" height="100">
				</td>
				<td><?= $row["nim"] ?></td>
				<td><?= $row["nama"] ?></td>
				<td><?= $row["email"] ?></td>
				<td><?= $row["jurusan"] ?></td>
			</tr>
		<?php $i++; ?>
		<?php endforeach; ?>


	</table>

	</div>

	<script type="text/javascript" src="js/script.js"></script>

</body>
</html>