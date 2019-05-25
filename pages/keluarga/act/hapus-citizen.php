<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id = base64_decode( $_GET['id'] );
		$sql = pg_query("DELETE FROM citizen WHERE national_identity_number = '$id'");
		if ($sql){
			echo '<script>
				$("#sukses-hapus").modal("show");
				</script>
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				';
		}
		echo '<meta http-equiv="REFRESH" content="1;url=../">';
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>