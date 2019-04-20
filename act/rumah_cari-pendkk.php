<?php
require '../inc/koneksi.php';
session_start();
if(isset($_SESSION['username'])) {	
	$pendkk = $_GET["pendkk"];

	$querysearch = " 	SELECT H.house_building_id, ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) AS latitude
						FROM house_building AS H
						JOIN family_card AS O ON H.house_building_id=O.house_building_id
						WHERE educational_id = '$pendkk' ORDER BY house_building_id
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