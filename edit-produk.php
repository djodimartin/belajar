<?php
	session_start();
	include 'db.php';
	 //ini code untuk login, jika tidak login tidak bisa masuk ke dashboard (halaman website) 
	if ($_SESSION['status_login'] != true) {
		echo '<script>window.location="login.php"</script>';
	}
	// mengambil data dalam variabel 
	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
	if(mysqli_num_rows($produk) == 0) {
		echo '<script>window.location="data-produk.php"</script>';
	}
	$p = mysqli_fetch_object($produk);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Website Djodi Martin</title>
	<link rel="stylesheet" type ="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
</head>

<body>
	<!--HEADER -->
	<header>
		<div class="container">
		<h1><a href="dashboard.php">Djodi Martin </a></h1>
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
			<h3>Edit Data Produk</h3>
			<div class="box">
				 <!-- mengambil dari tabel admin di localhost-->
				<form action="" method="POST" enctype="multipart/form-data">
					<select class="input-control" name="kategori" required>
						<option value="">--Pilih--</option>
						<?php 
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							while($r = mysqli_fetch_array($kategori)){  // menyimpan data dalam array 
						?>
						<option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id) ? 'selected':''; ?>><?php echo $r['category_name'] ?></option>
						<?php } ?>
					</select>

					<input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
					<input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
					<!-- edit gambar-->
					<img src="produk/<?php echo $p->product_image ?>" width="140px">
					<input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
					<input type="file" name="gambar" class="input-control" >
					<!-- deskripsi -->
					<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->product_description ?></textarea><br>
					<select class="input-control" name="status">
						 <!--Status Produk-->
						<option value="">--Pilih--</option>
						<option value="1" <?php echo ($p->product_status == 1)? 'selected':''; ?>>--Aktif--</option> <!-- Jika aktif produk akan nampil di halaman calon pembeli -->
						<option value="0" <?php echo ($p->product_status == 0)? 'selected':''; ?>>--Tidak Aktif--</option>	<!-- jika tidak nampil stok habis Karena value 0 -->
					</select>
					<input type="submit" name="submit" value="submit" class="btn">
				</form>	

				<?php 
					if (isset($_POST['submit'])){
						
						// input data dari form
						$kategori 	= $_POST['kategori'];
						$nama 		= $_POST['nama'];
						$harga 		= $_POST['harga'];
						$deskripsi 	= $_POST['deskripsi'];
						$status 	= $_POST['status'];
						$foto	 	= $_POST['foto'];

						// menampung data gambar yang baru
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

						
						// jika admin nya ganti gambar apa yang di lakukan 
						if ($filename != '') {
							$type1 = explode('.', $filename);
							$type2 = $type1['1'];

							$newname = 'produk'.time().'.'.$type2;

							// menampung data format file yang di (izinkan)
							$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif','jfif');

							// validasi format file 
							if (!in_array($type2, $tipe_diizinkan)){

								echo '<script>alert("Format file tidak di izinkan")</script>'; // jika format yang kita upload tidak ada di dalam array di atas maka akan muncul notif format file tidak di temukan
							}else {
								// proses upload file sekaligus insert database
								unlink('./produk/'.$foto); // hapus
								move_uploaded_file($tmp_name, './produk/'.$newname);	 // upload file
								$namagambar = $newname; // menampung data gambar baru dalam variabel namagambar
							}

						}else{
							// jika admin tidak ganti gambar apa yang akan di lakukan
							$newname = $foto;
						}

						// query untuk update data produk
						$update = mysqli_query($conn, "UPDATE tb_product SET 
												category_id = '".$kategori."',
												product_name = '".$nama."',
												product_price = '".$harga."',
												product_description = '".$deskripsi."',
												product_image = '".$namagambar."',
												product_status = '".$status."'
												WHERE product_id = '".$p->product_id."'	");
						// kondisi jika gagal dan berhasi;						
						if ($update) {
							echo '<script>alert("Ubah data berhasil")</script>';
							echo '<script>window.location="data-produk.php"</script>';
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
	<script>
    	CKEDITOR.replace( 'deskripsi' );
    </script>

</body>
</html>