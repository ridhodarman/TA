<?php
require '../inc/koneksi.php';
session_start();
if(isset($_SESSION['username'])) {	
	$awal = str_replace(".", "", $_GET['awal']);
	$akhir = str_replace(".", "", $_GET['akhir']);

	$querysearch = " 	SELECT H.house_building_id, ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) AS latitude
						FROM house_building AS H
						JOIN householder AS O ON H.house_building_id=O.house_building_id
						WHERE income BETWEEN '$awal' AND '$akhir' ORDER BY house_building_id
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