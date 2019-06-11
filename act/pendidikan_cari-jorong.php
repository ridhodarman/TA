
<?php
require '../inc/koneksi.php';

$j_id = $_GET["j"];

$querysearch = " 	SELECT 
					E.educational_building_id,
					E.name_of_educational_building,
					ST_X(ST_CENTROID(E.geom)) AS longitude,
					ST_Y(ST_CENTROID(E.geom)) AS latitude 
					FROM educational_building AS E, jorong AS J 
					WHERE ST_CONTAINS(J.geom, E.geom) AND J.jorong_id='$j_id'";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['educational_building_id'];
    $name = $row['name_of_educational_building'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $dataarray[] = array('id' => $id, 'name' => $name, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
?>