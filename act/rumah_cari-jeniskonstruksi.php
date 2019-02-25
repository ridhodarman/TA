
<?php
require '../inc/koneksi.php';

$type = $_GET["k"];

$querysearch = " 	SELECT house_building_id, ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) As latitude
					FROM house_building 
                    WHERE type_of_construction = '$type' order by house_building_id
				";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['house_building_id'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $dataarray[] = array('id' => $id, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
?>