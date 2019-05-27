<?php
require '../inc/koneksi.php';
session_start();
if(isset($_SESSION['username'])) {	
	$nama = strtoupper($_GET["nama"]);

	$querysearch = " 	SELECT H.house_building_id, ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) AS latitude
						FROM house_building AS H
						JOIN house_building_owner AS O ON H.fcn_owner=O.national_identity_number
						WHERE upper(O.owner_name) LIKE'%$nama%' ORDER BY house_building_id
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