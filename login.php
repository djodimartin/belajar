<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Website Djodi Martin</title>
	<link rel="stylesheet" type ="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body id="bg-login">
	<div class="box-login">
		<h2>Login UKM</h2>
		<form action="" method="POST">
			<input type="text" name="user" placeholder="Username" class="input-control">
			<input type="password" name="pass" placeholder="Password" class="input-control">
			<input type="submit" name="submit" value="Login" class="btn">
		</form>
		<?php
			if (isset($_POST['submit'])){ // di ambil dari input class type submit
				session_start();
				include 'db.php'; // class include untuk memanggil file db.php 
				// user dan pass di ambil dari name (variabel) di input type ! 
				$user = mysqli_real_escape_string($conn, $_POST ['user']); // berfungsi untuk mencegah orang tidak bertanggung jawab, misal nya hacker dll
				$pass = mysqli_real_escape_string($conn, $_POST ['pass']); // berfungsi untuk mencegah orang tidak bertanggung jawab, misal nya hacker dll

				$cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '" .$user."' AND password = '".MD5($pass)."'"); // jadi kita akan select table admin username dan password nya adalah user input an yang ada di atas 
				if (mysqli_num_rows($cek) > 0){ // ada berapa baris data tersebut misal nya 0 atau 1 
					$d = mysqli_fetch_object($cek);
					$_SESSION['status_login'] = true;
					$_SESSION['a_global'] = $d;
					$_SESSION['id'] = $d->admin_id;
					echo '<script>window.location="dashboard.php"</script>';

			} else { // if  kalau data sesuai di data base berhasil login ke dashboard, else kalau data ga ada di database gagal login
				echo '<script>alert("Username Atau password Anda salah!")</script>'; 	
		}
	}
		?>	
	</div>

</body>
</html>