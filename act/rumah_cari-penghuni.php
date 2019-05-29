<?php
require '../inc/koneksi.php';
session_start();
if(isset($_SESSION['username'])) {	
	$nama = strtolower($_GET["nama"]);

	$querysearch = " 	SELECT H.house_building_id, C.name, ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) AS latitude
						FROM house_building AS H
						JOIN family_card AS F ON F.house_building_id=H.house_building_id
						JOIN citizen AS C ON F.family_card_number=C.family_card_number
						WHERE lower(C.name) LIKE'%$nama%' ORDER BY house_building_id
					";

	$hasil = pg_query($querysearch);
	while ($row = pg_fetch_array($hasil)) {
	    $id = $row['house_building_id'];
	    $longitude = $row['longitude'];
	    $latitude = $row['latitude'];
	    $nama = $row['name'];
	    $lokasirumah ="<b>".$id."</b> (".$nama.")";
	    $dataarray[] = array('id' => $lokasirumah, 'longitude' => $longitude, 'latitude' => $latitude);
	}
	echo json_encode($dataarray);
}
?>