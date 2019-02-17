<?php
	include ('../../../inc/koneksi.php');

	$id = $_GET['id'];
	$jenis = $_GET['jenis-baru'];

	$sql = pg_query("UPDATE type_of_construction SET name_of_type = '$jenis' WHERE type_id = '$id'");
?>