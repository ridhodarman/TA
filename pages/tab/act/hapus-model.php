<?php
	include ('../../../inc/koneksi.php');
	$id = base64_decode( $_GET['id'] );
	$sql = pg_query("DELETE FROM building_model WHERE model_id = '$id'");
?>