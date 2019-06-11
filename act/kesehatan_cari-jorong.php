
<?php
require '../inc/koneksi.php';

$j_id = $_GET["j"];

$querysearch = " 	SELECT 
					H.health_building_id,
					H.name_of_health_building,
					ST_X(ST_CENTROID(H.geom)) AS longitude,
					ST_Y(ST_CENTROID(H.geom)) AS latitude 
					FROM health_building AS H, jorong AS J 
					WHERE ST_CONTAINS(J.geom, H.geom) AND J.jorong_id='$j_id'";

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