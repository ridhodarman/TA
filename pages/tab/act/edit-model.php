<?php
	include ('../../../inc/koneksi.php');
	$id = $_GET['id'];
	$model = $_GET['jenis-baru'];
	$sql = pg_query("UPDATE building_model SET name_of_model = '$model' WHERE model_id = '$id'");
?>