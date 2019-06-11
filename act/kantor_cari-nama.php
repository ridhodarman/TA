<?php
require '../inc/koneksi.php';
$nama = strtolower($_GET["cari_nama"]);

$querysearch = " 	SELECT office_building_id, name_of_office_building ,ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) AS latitude
					FROM office_building WHERE LOWER(name_of_office_building) LIKE '%$nama%' ORDER BY name_of_office_building ";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['office_building_id'];
    $name = $row['name_of_office_building'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $dataarray[] = array('id' => $id, 'name' => $name, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
