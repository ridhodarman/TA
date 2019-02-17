<?php
	include ('../../../inc/koneksi.php');

	$result = pg_query("SELECT MAX(type_id) AS id FROM type_of_construction");
    $row = pg_fetch_array($result);
    $id = $row["id"];
    $id2 = $id+1;

	$jenis = $_POST['jenis'];

	$sql = pg_query("INSERT INTO type_of_construction (type_id, name_of_type) VALUES ($id2, '$jenis')");
?>