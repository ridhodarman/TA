<?php
require '../inc/koneksi.php';
session_start();
if(isset($_SESSION['username'])) {	
	$suku = $_GET["suku"];

	$querysearch = " 	SELECT H.house_building_id, ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) AS latitude
						FROM house_building AS H
						JOIN citizen AS C ON H.owner_id=C.national_identity_number
						JOIN datuk AS D ON C.datuk_id=D.datuk_id
						JOIN tribe AS T ON D.tribe_id=T.tribe_id
						WHERE T.tribe_id = '$suku' ORDER BY house_building_id
					";

	$hasil = pg_query($querysearch);
	while ($row = pg_fetch_array($hasil)) {
	    $id = $row['house_building_id'];
	    $longitude = $row['longitude'];
	    $latitude = $row['latitude'];
	    // $nik = $row['national_identity_number'];
	    // $lokasirumah ="<b>".$id."</b> (".$nik.")";
	    $dataarray[] = array('id' => $id, 'longitude' => $longitude, 'latitude' => $latitude);
	}
	echo json_encode($dataarray);
}
?>