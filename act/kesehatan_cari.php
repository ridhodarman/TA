<?php
require '../inc/koneksi.php';

$querysearch = " 	SELECT health_building_id, name_of_health_building ,ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) AS latitude
					FROM health_building ORDER BY name_of_health_building
				";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['health_building_id'];
    $name = $row['name_of_health_building'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $dataarray[] = array('id' => $id, 'name' => $name, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
