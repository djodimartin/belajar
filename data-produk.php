<?php
	session_start();
	include'db.php';
	if ($_SESSION['status_login'] != true) {
		echo '<script>window.location="login.php"</script>';
	}
?>

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
			<h3>Data Produk UKM</h3>
			<h4>Selamat datang <?php echo $_SESSION['a_global'] -> admin_name ?> Di Data Produk E-COMMERCE UMKM</h4>
			<div class="box">
				<!-- menambah data-->
				<p><a href="tambah-produk.php">Tambah Data</a></p>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr> 
							<th width="60px">No</th>
							<th>Kategori</th>
							<th>Nama Produk</th>
							<th width="130px">Harga</th>
							<th>Deskripsi</th>
							<th>Gambar</th>
							<th>Status</th>
							<th width="120px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<!-- DESKRIPSI HAPUS JADI ADA 7 ROW -->
						<?php 
							$no =1;
							$produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
							if(mysqli_num_rows($produk) > 0) {// keterangan bahwa data tidak ada
							while ($row = mysqli_fetch_array($produk)){

						?>
						<tr>
							<!-- menampilkan data dari tabel localhost-->
							<td><?php echo $no ++ ?></td>
							<td><?php echo $row['category_name'] ?></td>
							<td><?php echo $row['product_name'] ?></td>
							<td>Rp. <?php echo number_format($row['product_price']) ?></td>
							<td><?php echo $row['product_description'] ?></td>
							<td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"> <img src="produk/<?php echo $row['product_image'] ?>"width="70px"></a></td>
							<td><?php echo ($row['product_status']  == 0)?'Tidak Ready':'Ready'?></td>
							<td>
								<a href="edit-produk.php?id=<?php echo $row['product_id'] ?>">Edit</a> || <a href="proses-hapus.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('Apakah yakin ingin menghapus Produk?')">Hapus</a>
							</td>
						</tr>
					<?php } } else {?>
						<tr>
							<td colspan="8">tidak ada data</td>
						</tr>
						<?php } ?>

					</tbody>
				</table>
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