<?php
require '../inc/koneksi.php';
$model = $_GET["model"];

$querysearch = " 	SELECT worship_building_id, name_of_worship_building, ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) AS latitude
					FROM worship_building
					WHERE model_id = '$model' ORDER BY worship_building_id
				";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['worship_building_id'];
    $name = "<i class='fas fa-mosque'></i> ".$row['name_of_worship_building'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $dataarray[] = array('id' => $id, 'name' => $name, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
?>