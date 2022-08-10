<?php
	session_start();
	include 'db.php';
	if ($_SESSION['status_login'] != true) {
		echo '<script>window.location="login.php"</script>';
	}
	// menampung variabel dalam query yang dimana variabel conn
    // yang mengambil data dari tb_admin berdasarkan admin_id yang lagi login
	$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
	// mengambil data yang dimana data dalam bentuk objek yang dimana bernama variabel $d
	$d = mysqli_fetch_object($query);
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
		<h1><a href="dashboard.php">Website Toko Online UKM </a></h1>
		<ul>
			<li><a href="dashboard.php">Beranda</a></li>
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
			<h3>Profil</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="text" name="nama" placeholder="Nama Lengkap"class="input-control" value="<?php echo $d->admin_name?>" required>
					<input type="text" name="user" placeholder="Username"class="input-control" value="<?php echo $d->username?>" required>
					<input type="text" name="hp" placeholder="No Hp"class="input-control" value="<?php echo $d->admin_telp?>" required>
					<input type="email" name="email" placeholder="Email"class="input-control" value="<?php echo $d->admin_email?>" required>
					<input type="text" name="alamat" placeholder="Alamat"class="input-control" value="<?php echo $d->admin_address?>" required>
					<input type="submit" name="submit" value="Ubah Profil" class="btn">
				</form>
				<!-- proses ubah data-->
				<?php 
					if(isset($_POST['submit'])){
						// ketika tombol (submit/ubah data)di tekan melakukan proses ubah data
                        // menampung dalam variabel  nama, user, hp, email, alamat
						$nama 	= ucwords($_POST['nama']);
						$user 	= $_POST['user'];
						$hp 	= $_POST['hp'];
						$email 	= $_POST['email'];
						$alamat = ucwords($_POST['alamat']);
						// query update menampung dalam variabel update terdiri dari nama, user, hp, email, dan address
						$update = mysqli_query($conn, "UPDATE tb_admin SET 
										admin_name = '".$nama."', 
										username = '".$user."', 
										admin_telp = '".$hp."', 
										admin_email = '".$email."', 
										admin_address = '".$alamat."' 
										WHERE admin_id = '".$d->admin_id."'");
						// mengecek 				
						if($update) {
							echo '<script>alert("Ubah Data Berhasil")</script>';
							echo '<script>window.location="profil.php"</script>';
						}else {
							echo 'gagal '.mysqli_error($conn);
						}

					}
				?>
			</div>

			<!-- ubah password -->
			<h3>Ubah Password</h3>
			<div class="box">
				<!-- mengambil dari tabel admin di localhost-->
				<form action="" method="POST">
					<input type="password" name="pass1" placeholder="Password Baru"class="input-control" required>
					<input type="password" name="pass2" placeholder="Konfirmasi Password Baru"class="input-control" required>
					<input type="submit" name="ubah_password" value="Ubah Password" class="btn">
				</form>
				<!-- proses ubah data-->
				<?php 
					if(isset($_POST['ubah_password'])){
					 	// Prosses Ubah password
						$pass1 	= $_POST['pass1'];
						$pass2 	= $_POST['pass2'];
						// kondisi
						if($pass2 != $pass1) {
							echo '<script>alert("Konfirmasi Passowrd Baru tidak sesuai ")</script>';
						}else {

							$u_pass = mysqli_query($conn, "UPDATE tb_admin SET 
										password = '".MD5($pass1)."' 
										WHERE admin_id = '".$d->admin_id."'");

							if($u_pass) {

								echo '<script>alert("Ubah Data Berhasil")</script>';
								echo '<script>window.location="profil.php"</script>';
							}else {
								echo 'gagal '.mysqli_error($conn);
							}
						}
					}
				?>
			</div>


		</div>
	</div>

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy;2022 - Websie Toko Online UKM</small>
		</div>
	</footer>

</body>
</html>