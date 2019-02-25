<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		$id = $_GET['id'];
		$a = $_GET['aset-edit'];
		$sql = pg_query("UPDATE asset SET name_of_asset = '$a' WHERE asset_id = '$id'");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>