<?php
	session_start();
	include 'db.php';
	if ($_SESSION['status_login'] != true) {
		echo '<script>window.location="login.php"</script>';
	}

	$kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."' ");
	if (mysqli_num_rows($kategori)== 0) {
		echo '<script>window.location="data-kategori.php"</script>';
	}
	// mengambil data dalam bentuk objek
	$k = mysqli_fetch_object($kategori);


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Website Djodi Martin</title>
	<link rel="stylesheet" type ="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
	<!--HEADER -->
	<header>
		<div class="container">
		<h1><a href="dashboard.php">PASTI BISA </a></h1>
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
			<h3>Edit Data Kategori</h3>
			<div class="box">
				<!-- mengambil data dari tabel admin di localhost-->
				<form action="" method="POST">
					<input type="text" name="nama" placeholder="Nama Kategori"class="input-control" value="<?php echo $k-> category_name ?>" required>
					<input type="submit" name="submit" value="submit" class="btn">
				</form>	
				<!-- Menambah Data-->
				<?php 
					if (isset($_POST['submit'])){
						$nama = ucwords($_POST['nama']);
						// proses edit
						$update = mysqli_query($conn, "UPDATE tb_category SET 
											category_name ='".$nama."'
											WHERE category_id ='".$k->category_id."' ");
						// mengecek
						if($update) {
							echo '<script>alert("Edit Data Berhasil")</script>'; 
							echo '<script>window.location="data-kategori.php"</script>'; // ketika berhasil Edit langsung ke lempar ke data kategori
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