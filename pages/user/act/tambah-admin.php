<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['username'] != null  && $_SESSION['role'] == 1) {

		include ('../../../inc/koneksi.php');

		$username = $_POST['username'];
		$password = md5( $_POST['password'] );

		$sql = pg_query("INSERT INTO user_account (username, password, role) VALUES ('$username', '$password', '0')");
	}

	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>