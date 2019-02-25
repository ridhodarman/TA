<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		$username = $_POST['usr-edit'];
		$temp = $_POST['usr-temp'];
		$password = md5( $_POST['pw-edit'] );
		$sql = pg_query("UPDATE user_account SET 
						username = '$username',
						password = '$password'
						WHERE username = '$temp'");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>