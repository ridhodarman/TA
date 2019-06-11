<?php
	session_start();
    if(isset($_SESSION['username']) && $_SESSION['role'] == 1) {
		include ('../../../inc/koneksi.php');
		$id = base64_decode( $_GET['id'] );
		$sql = pg_query("DELETE FROM user_account WHERE username = '$id'");
	}
?>