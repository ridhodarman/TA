<?php
	session_start();
    if(isset($_SESSION['username']) && $_SESSION['role'] == 1) {
		include ('../../../inc/koneksi.php');
		include ('../inc/notif-act.php');
		$username = $_POST['usr-edit'];
		$temp = $_POST['usr-temp'];
		$password = md5( $_POST['pw-edit'] );
		$sql = pg_query("UPDATE user_account SET 
						username = '$username',
						password = '$password'
						WHERE username = '$temp'");
		if ($sql) {
			echo '	<script>
					$("#sukses").modal("show");
					</script>
					<meta http-equiv="REFRESH" content="1;url=../">
			';
		}
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>