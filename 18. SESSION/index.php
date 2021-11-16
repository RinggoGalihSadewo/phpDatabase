<?php 






session_start();

if ( !isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}
	
require 'functions.php';



$mahasiswa = query("SELECT * FROM mahasiswa");

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
		<input type="text" name="keyword" size="40" autofocus="" placeholder="Masukan keyword pencarian" autocomplete="off">
		<button type="submit" name="cari">Cari</button>
	</form>

	<br>

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

</body>
</html>