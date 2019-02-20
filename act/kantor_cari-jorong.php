
<?php
require '../inc/koneksi.php';

$j_id = $_GET["j"];

$querysearch = " 	SELECT 
					O.office_building_id,
					O.name_of_office_building,
					O.geom,
					ST_X(ST_CENTROID(O.geom)) as longitude,
					ST_Y(ST_CENTROID(O.geom)) as latitude 
					FROM office_building AS O, jorong AS J 
					WHERE ST_CONTAINS(J.geom, O.geom) and J.jorong_id='$j_id'";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['office_building_id'];
    $name = $row['name_of_office_building'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $dataarray[] = array('id' => $id, 'name' => $name, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
?>