<<?php 
	session_start();
	session_destroy(); // kode untuk keluar/logout dari dashboard ke halaman login
	echo '<script>window.location="login.php"</script>'
?>