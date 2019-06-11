<?php
require '../inc/koneksi.php';
session_start();
if(isset($_SESSION['username'])) {	
	$kk = strtolower($_GET["kk"]);

	$querysearch = " 	SELECT H.house_building_id, F.family_card_number, ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) AS latitude
						FROM house_building AS H
						JOIN family_card AS F ON F.house_building_id=H.house_building_id
						WHERE lower(F.family_card_number) LIKE'%$kk%' ORDER BY house_building_id
					";

	$hasil = pg_query($querysearch);
	while ($row = pg_fetch_array($hasil)) {
	    $id = $row['house_building_id'];
	    $longitude = $row['longitude'];
	    $latitude = $row['latitude'];
	    $kk = $row['family_card_number'];
	    $lokasirumah ="<b>".$id."</b> (".$kk.")";
	    $dataarray[] = array('id' => $id, 'nama' => $lokasirumah, 'longitude' => $longitude, 'latitude' => $latitude);
	}
	echo json_encode($dataarray);
}
?>