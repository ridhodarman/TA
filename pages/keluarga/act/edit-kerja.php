<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		$id = $_GET['id'];
		$k = $_GET['kerja-edit'];
		$sql = pg_query("UPDATE job SET job_name = '$k' WHERE job_id = '$id'");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>