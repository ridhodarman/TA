<?php
require '../inc/koneksi.php';
session_start();
if(isset($_SESSION['username'])) {	
	$model = $_GET["model"];

	$querysearch = " 	SELECT health_building_id, name_of_health_building, ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) AS latitude
						FROM health_building
						WHERE model_id = '$model' ORDER BY health_building_id
					";

	$hasil = pg_query($querysearch);
	while ($row = pg_fetch_array($hasil)) {
	    $id = $row['health_building_id'];
	    $name = "<i class='fas fa-hospital-alt'></i> ".$row['name_of_health_building'];
	    $longitude = $row['longitude'];
	    $latitude = $row['latitude'];
	    $dataarray[] = array('id' => $id, 'name' => $name, 'longitude' => $longitude, 'latitude' => $latitude);
	}
	echo json_encode($dataarray);
}
?>