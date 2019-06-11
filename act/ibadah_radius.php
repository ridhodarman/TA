<?php
include '../inc/koneksi.php';
$latit = $_GET["lat"];
$longi = $_GET["lng"];
$rad = $_GET["rad"];

$querysearch = "SELECT worship_building_id, name_of_worship_building ,ST_X(ST_CENTROID(geom)) AS lon, ST_Y(ST_CENTROID(geom)) AS lat,
				ST_DISTANCE_SPHERE(ST_GeomFromText('POINT(" . $longi . " " . $latit . ")',-1), geom) AS jarak
				FROM worship_building where ST_DISTANCE_SPHERE(ST_GeomFromText('POINT(" . $longi . " " . $latit . ")',-1),
				geom) <= " . $rad . " ORDER BY jarak
				";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['worship_building_id'];
    $name = $row['name_of_worship_building'];
    $longitude = $row['lon'];
    $latitude = $row['lat'];
    $dataarray[] = array('id' => $id, 'name' => $name,
        'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);