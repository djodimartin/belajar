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
	<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
</head>

<body>
	<!--HEADER -->
	<header>
		<div class="container">
		<h1><a href="dashboard.php">Website Toko Online UKM </a></h1>
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
			<h3>Tambah Data Produk Jualan Anda</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<select class="input-control" name="kategori" required>
						<option value="">--Pilih Kategori Produk--</option>
						<?php 
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							while($r = mysqli_fetch_array($kategori)){ // menyimpan data dalam array 
						?>
						<option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
						<?php } ?>
					</select>

					<input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
					<input type="text" name="harga" class="input-control" placeholder="Harga" required>
					<input type="file" name="gambar" class="input-control" required>
					<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br>
					<select class="input-control" name="status">

						<option value="">--Pilih--</option>
						<option value="1">--Ready--</option> <!-- Jika aktif produk akan nampil di halaman calon pembeli -->
						<option value="0">--Tidak Ready--</option>	<!-- jika tidak nampil stok habis Karena value 0 -->
					</select>
					<input type="submit" name="submit" value="submit" class="btn">
				</form>	

				<?php 
					if (isset($_POST['submit'])){
						/* proses saat tombol di klik dan untuk file ini terdapat beberapa data
                         mengecek ada data apa aja yang ada di dalam file */

                        // menampung inputan dari from
						$kategori = $_POST['kategori'];
						$nama = $_POST['nama'];
						$harga = $_POST['harga'];
						$deskripsi = $_POST['deskripsi'];
						$status = $_POST['status'];

						// menampung data file yang di upload misal bentuk file nya apa
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

						// type file nya apa misal jpeg jpg
						$type1 = explode('.', $filename); // untuk mengubah text menjadi array 
						$type2 = $type1['1']; // mencari tau isinya apa
						$newname = 'produk'.time().'.'.$type2; // eksekusi

						/* menampung data format filenya yang di (izinkan)
                        jadi file yang boleh masuk ke Database format nya apa aja yang bisa di upload ke Database */
						$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif','jfif');

						// validasi format file 
						if (!in_array($type2, $tipe_diizinkan)){
							/* maksudnya jika format file yang kita upload
                            format nya tidak ada di dalam array di atas maka */
							echo '<script>alert("Format file tidak di izinkan")</script>'; // jika format yang kita upload tidak ada di dalam array di atas maka akan muncul notif format file tidak di temukan
						}else {
							// jika format file nya sesuai yang ada di dalam array type di izinkan
							move_uploaded_file($tmp_name, './produk/'.$newname);
							// Proses Upload File sekaligus Insert/Menambah Database 
							$insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
										null,
										'".$kategori."',
										'".$nama."',
										'".$harga."',
										'".$deskripsi."',
										'".$newname."',
										'".$status."',
										null
											) ");

							if ($insert) {
								echo '<script>alert("Tambah data berhasil")</script>';
								echo '<script>window.location="data-produk.php"</script>';
							}else {
								echo 'gagal'.mysqli_error($conn);
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
			<small>Copyright &copy;2022 - Websie Djodi Martin 197064516094</small>
		</div>
	</footer>
	<script>
    	CKEDITOR.replace( 'deskripsi' );
    </script>

</body>
</html>