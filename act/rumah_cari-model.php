<?php
require '../inc/koneksi.php';	
$model = $_GET["model"];

$querysearch = " 	SELECT house_building_id, ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) AS latitude
					FROM house_building
					WHERE model_id = '$model' ORDER BY house_building_id
				";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['house_building_id'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $dataarray[] = array('id' => $id, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
?>