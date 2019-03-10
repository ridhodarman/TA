
<?php
require '../inc/koneksi.php';

$j_id = $_GET["j"];

$querysearch = " 	SELECT 
					W.health_building_id,
					W.name_of_health_building,
					W.geom,
					ST_X(ST_CENTROID(W.geom)) as longitude,
					ST_Y(ST_CENTROID(W.geom)) as latitude 
					FROM health_building AS W, jorong AS J 
					WHERE ST_CONTAINS(J.geom, W.geom) and J.jorong_id='$j_id'";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['health_building_id'];
    $name = $row['name_of_health_building'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $dataarray[] = array('id' => $id, 'name' => $name, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
?>