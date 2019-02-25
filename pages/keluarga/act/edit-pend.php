<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		$id = $_GET['id'];
		$pend = $_GET['pend-edit'];
		$sql = pg_query("UPDATE education SET educational_level = '$pend' WHERE education_id = '$id'");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>