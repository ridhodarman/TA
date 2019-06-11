<?php
	if (isset($_POST['username'])) {
		include '../inc/koneksi.php';
		$user = $_POST['username'];
		$pass = md5($_POST['password']);
		$sql = pg_query("SELECT * FROM user_account where username='$user' and password='$pass'")or die(mysql_error());
		$row= pg_fetch_array($sql);
		if($row!=0){
			session_start();
		  	$_SESSION['username'] = $row['username'];
		  	$_SESSION['password'] = $row['password'];
		  	$_SESSION['role'] = $row['role'];
			header("location: ../");
		}
		else { 
			include '../inc/notif-act.php';
			echo '<script>
					$("#salah").modal("show");
					</script>
					<meta http-equiv="REFRESH" content="1;url=../">
					';
		}
	}
	else {
		header("location: ../assets/403");
	}
?>