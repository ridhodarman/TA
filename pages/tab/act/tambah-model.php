<?php
	include ('../../../inc/koneksi.php');

	$result = pg_query("SELECT MAX(model_id) AS id FROM building_model");
    $row = pg_fetch_array($result);
    $id = $row["id"];
    $id2 = $id+1;

	$model = $_POST['model2'];

	$sql = pg_query("INSERT INTO building_model (model_id, name_of_model) VALUES ($id2, '$model')");
?>