<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		$id = base64_decode( $_GET['id'] );
		$sql = pg_query("DELETE FROM type_of_msme WHERE type_id = '$id'");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>