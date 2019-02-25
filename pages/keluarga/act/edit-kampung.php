<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		$id = $_GET['id'];
		$k = $_GET['kampung-edit'];
		$sql = pg_query("UPDATE village SET village_name = '$k' WHERE village_id = '$id'");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>