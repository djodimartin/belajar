<?php
	session_start();
	include 'db.php';
	if ($_SESSION['status_login'] != true) {
		echo '<script>window.location="login.php"</script>';
	}
?>

<!-- ini code untuk login, jika tidak login tidak bisa masuk ke dashboard (halaman website) -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>websitedjodimrtin197064516094</title>
	<link rel="stylesheet" type ="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
	<!--HEADER -->
	<header>
		<div class="container">
		<h1><a href="dashboard.php">DJODI MARTIN</a></h1>
		<ul>
			<li><a href="dashboard.php">Dashboard</a></li>
			<li><a href="profil.php">Profil</a></li>
			<li><a href="data-kategori.php">Data Category</a></li>
			<li><a href="data-produk.php">Data Produk</a></li>
			<li><a href="keluar.php">Logout</a></li>
		</ul>
	</div>
</header>

	<!-- CONTENT -->

	<div class="section">
		<div class="container">
			<h3>Tambah Data Kategori</h3>
			<div class="box">
				 <!-- mengambil dari tabel admin di localhost-->
				<form action="" method="POST">
					<input type="text" name="nama" placeholder="Nama Kategori"class="input-control" required>
					<input type="submit" name="submit" value="submit" class="btn">
				</form>	
				 <!-- Menambah Data-->
				<?php 
					if (isset($_POST['submit'])){
						$nama = ucwords($_POST['nama']);
						$insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (
											null,
											'".$nama."')");
						// mengecek
						if($insert) {
							echo '<script>alert("Tambah Data Berhasil")</script>'; // ketika di klik muncul notif dan website langsung ke arah kategori produk
							echo '<script>window.location="data-kategori.php"</script>';
						}else {
							echo 'gagal'.mysqli_error($conn);
						}
					}
				?>

			</div>
		</div>
	</div>

	<!-- footer -->

	<footer>
		<div class="container">
			<small>Copyright &copy;2022 - Websie Djodi Martin 197064516094</small>
		</div>
	</footer>

</body>
</html>