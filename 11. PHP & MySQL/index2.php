<?php 
	



// Koneksi ke database

$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// ambil data dari tabel mahasiswa
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

// kondisi jika salah
// if(!$result) {
// 	echo mysqli_error($conn);
// }


// ambil data (fetch) mahasiswa dari object result
// mysqli_fetch_row() mengembalikan array numerik
// mysqli_fetch_assoc() mengembalikan array associative
// mysqli_fetch_array() mengembalikan numerik dan associative (double)
// mysqli_fetch_object() 

// while ( $mhs = mysqli_fetch_assoc($result) ){
// 	var_dump($mhs["nama"]);
// }

?>	

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
</head>
<body>

	<h1>Daftar Mahasiswa</h1>

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
		<?php while( $row = mysqli_fetch_assoc($result) ): ?>
		
			<tr>
				<td><?= $i ?></td>
				<td>
					<a href="#">Ubah</a> |
					<a href="#">Hapus</a>
				</td>
				<td>
					<img src="../img/<?= $row["gambar"] ?>" width="100" height="100">
				</td>
				<td><?= $row["nim"] ?></td>
				<td><?= $row["nama"] ?></td>
				<td><?= $row["email"] ?></td>
				<td><?= $row["jurusan"] ?></td>
			</tr>
		<?php $i++; ?>
		<?php endwhile ?>


	</table>

</body>
</html>