<?php
require '../inc/koneksi.php';

$querysearch = " 	SELECT msme_building_id, name_of_msme_building ,ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) As latitude
					FROM msme_building ORDER BY name_of_msme_building
				";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['msme_building_id'];
    $name = $row['name_of_msme_building'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $dataarray[] = array('id' => $id, 'name' => $name, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
