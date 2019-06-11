<?php
	include ('../../../inc/koneksi.php');
	$id = base64_decode( $_GET['id'] );
	$sql = pg_query("DELETE FROM type_of_construction WHERE type_id = '$id'");
?>