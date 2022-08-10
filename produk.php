	<?php
		error_reporting(0);
		include 'db.php';
		$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
		$a = mysqli_fetch_object($kontak);
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
			<h1><a href="index.php">Website Toko Online UKM </a></h1>
			<ul>
				<li><a href="produk.php">Beranda</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="data-kategori.php">Data Category</a></li>
				<li><a href="data-produk.php">Data Produk</a></li>
				<li><a href="keluar.php">Logout</a></li>
				
			</ul>
		</div>
	</header>
	<!-- Search -->
	<div class="search">
		<div class="container">
			<form action="produk.php"> <!-- Jika calon pembeli mencari produk akan pindah ke produk -->
			<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
			<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
			<input type="submit" name="cari" value="Cari Produk"> 	
			</form>
		</div>
	</div> 

		<!-- BAGIAN NEW PRODUK -->
		<div class="section">
			<div class="container">
				<h3>Product </h3>
				<div class="box">
					<?php 
						if ($_GET['search'] != '' || $_GET['kat'] != '') {
							$where = "AND product_name LIKE '%".$_GET['search']."%' AND category_id LIKE '%".$_GET['kat']."%' ";
						}
	                     $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where ORDER BY product_id DESC");
	                     if (mysqli_num_rows($produk) > 0) {
	                     	while($p = mysqli_fetch_array($produk)){
	                     
					?>
						<a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
							<div class="col-4">
								<img src="produk/<?php echo $p ['product_image'] ?>">
								<p class="nama"><?php echo substr($p ['product_name'], 0,40) ?></p>
								<p class="harga">Rp. <?php echo number_format($p ['product_price']) ?></p>
							</div>
						</a>
					<?php } }else{ ?>
	                     <p>Produk Tidak ada!</p>
					<?php } ?>
				</div>
			</div>
		</div>	

		<!-- footer -->
		<div class="footer">
			<div class="container">
				<h4>Alamat</h4>
				<p><?php echo $a->admin_address ?></p>

				<h4>Email</h4>
				<p><?php echo $a->admin_email ?></p>

				<h4>NPM</h4>
				<p>197064516094</p>

				<h4>No Hp</h4>
				<p><?php echo $a->admin_telp ?></p>
				<small>Copyright &copy; 2022 - Website Toko Online UKM </small>
			</div>
		</div>

	</body>
	</html>