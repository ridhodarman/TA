<?php
require '../inc/koneksi.php';
session_start();
if(isset($_SESSION['username'])) {
	$datuk = $_GET["datuk"];

	$querysearch = " 	SELECT H.house_building_id, ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) AS latitude
						FROM house_building AS H
						JOIN family_card AS O ON H.house_building_id=O.house_building_id
						WHERE datuk_id = '$datuk' ORDER BY house_building_id
					";

	$hasil = pg_query($querysearch);
	while ($row = pg_fetch_array($hasil)) {
	    $id = $row['house_building_id'];
	    $longitude = $row['longitude'];
	    $latitude = $row['latitude'];
	    $dataarray[] = array('id' => $id, 'longitude' => $longitude, 'latitude' => $latitude);
	}
	echo json_encode($dataarray);
}
?>