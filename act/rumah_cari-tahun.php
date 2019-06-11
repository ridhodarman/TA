<?php
require '../inc/koneksi.php';
session_start();
if(isset($_SESSION['username'])) {	
	$awal = $_GET["awal"];
	$akhir = $_GET["akhir"];

	$querysearch = " 	SELECT house_building_id, standing_year, ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) As latitude
						FROM house_building WHERE standing_year BETWEEN '$awal' AND '$akhir' ORDER BY house_building_id
					";

	$hasil = pg_query($querysearch);
	while ($row = pg_fetch_array($hasil)) {
	    $id = $row['house_building_id'];
	    $longitude = $row['longitude'];
	    $latitude = $row['latitude'];
	    $tahun = $row['standing_year'];
	    $lokasirumah ="<b>".$id."</b> (".$tahun.")";
	    $dataarray[] = array('id' => $id, 'nama' => $lokasirumah, 'longitude' => $longitude, 'latitude' => $latitude);
	}
	echo json_encode($dataarray);
}
?>