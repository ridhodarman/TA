<?php
require '../inc/koneksi.php';
$j_id = $_GET["j"];

$querysearch = " 	SELECT 
					W.worship_building_id,
					W.name_of_worship_building,
					ST_X(ST_CENTROID(W.geom)) AS longitude,
					ST_Y(ST_CENTROID(W.geom)) AS latitude 
					FROM worship_building AS W, jorong AS J 
					WHERE ST_CONTAINS(J.geom, W.geom) AND J.jorong_id='$j_id'";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['worship_building_id'];
    $name = $row['name_of_worship_building'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $dataarray[] = array('id' => $id, 'name' => $name, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
?>