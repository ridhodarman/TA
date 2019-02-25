<?php
	session_start();
    if(isset($_SESSION['username'])) {
    	include ('../inc/notif2.php');
		include ('../../../inc/koneksi.php');
		$user = $_POST["username"];
		$pw = md5( $_POST["pw"] );
		$sql = pg_query("UPDATE user_account SET password = '$pw' WHERE username = '$user'");
		if ($sql) {
			echo '<script>
				$("#sukses").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../akun.php">
				';
		}
		else {
				echo '<script>
				$("#gagal").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../akun.php">
				';
		}
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>