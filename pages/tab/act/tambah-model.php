<?php
session_start();
if(isset($_SESSION['username']) && $_POST['model2'] != null ) {
	include ('../../../inc/koneksi.php');
	$result = pg_query("SELECT model_id AS id FROM building_model");
    $id=0;
	while ($data=pg_fetch_assoc($result)) {
		echo $temp=str_replace("B", "", $data["id"]);
		if ($id<$temp) {
			$id=$temp;
		}
	}
    $id = $id+1;
    if ($id<10) {
    	$id2="B0".$id;
    }
    else {
    	$id2="B".$id;
    }
	$model = $_POST['model2'];
	$sql = pg_query("INSERT INTO building_model (model_id, name_of_model) VALUES ('$id2', '$model')");
}
?>