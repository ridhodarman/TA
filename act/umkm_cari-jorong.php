
<?php
require '../inc/koneksi.php';

$j_id = $_GET["j"];

$querysearch = " 	SELECT 
					M.msme_building_id,
					M.name_of_msme_building,
					M.geom,
					ST_X(ST_CENTROID(M.geom)) as longitude,
					ST_Y(ST_CENTROID(M.geom)) as latitude 
					FROM msme_building AS M, jorong AS J 
					WHERE ST_CONTAINS(J.geom, M.geom) and J.jorong_id='$j_id'";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['msme_building_id'];
    $name = $row['name_of_msme_building'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $dataarray[] = array('id' => $id, 'name' => $name, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
?>