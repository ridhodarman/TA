<?php
require '../inc/koneksi.php';
session_start();
if(isset($_SESSION['username'])) {	
	$nik = strtolower($_GET["nik"]);

	$querysearch = " 	SELECT H.house_building_id, C.national_identity_number, ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.					geom)) AS latitude
						FROM house_building AS H
						JOIN family_card AS F ON F.house_building_id=H.house_building_id
						JOIN citizen AS C ON F.family_card_number=C.family_card_number
						WHERE lower(C.national_identity_number) LIKE'%$nik%' ORDER BY house_building_id
					";

	$hasil = pg_query($querysearch);
	while ($row = pg_fetch_array($hasil)) {
	    $id = $row['house_building_id'];
	    $longitude = $row['longitude'];
	    $latitude = $row['latitude'];
	    $nik = $row['national_identity_number'];
	    $lokasirumah ="<b>".$id."</b> (".$nik.")";
	    $dataarray[] = array('id' => $lokasirumah, 'longitude' => $longitude, 'latitude' => $latitude);
	}
	echo json_encode($dataarray);
}
?>