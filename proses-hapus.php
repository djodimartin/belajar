<?php 
	
	include 'db.php';

	if(isset($_GET['idk'])){
		$delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '".$_GET['idk']."' ");
		echo '<script>window.location="data-kategori.php"</script>';
	}

	if (isset($_GET['idp'])) {
		// ketika data di hapus maka data product (gambar) juga ikut ke hapus
		$produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '".$_GET['idp']."'  ");
		$p = mysqli_fetch_object($produk);

		unlink('./produk/'.$p-> product_image); // jadi ini menghapus gambar yang ada di dalam folder product

 		/* jika ada kiriman id masuk ke proses hapus
        maka akan melakukan proses hapus data */
		$delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '".$_GET['idp']."' ");
		echo '<script>window.location="data-produk.php"</script>';
	}

?>