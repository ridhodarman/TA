<?php
include '../inc/koneksi.php';
$latit = $_GET["lat"];
$longi = $_GET["lng"];
$rad = $_GET["rad"];

$querysearch = "SELECT health_building_id, name_of_health_building ,ST_X(ST_CENTROID(geom)) as lon, ST_Y(ST_CENTROID(geom)) as lat,
				ST_DISTANCE_SPHERE(ST_GeomFromText('POINT(" . $longi . " " . $latit . ")',-1), geom) as jarak
				FROM health_building where ST_DISTANCE_SPHERE(ST_GeomFromText('POINT(" . $longi . " " . $latit . ")',-1),
				geom) <= " . $rad . " ORDER BY jarak
				";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['health_building_id'];
    $name = $row['name_of_health_building'];
    $longitude = $row['lon'];
    $latitude = $row['lat'];
    $dataarray[] = array('id' => $id, 'name' => $name,
        'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);