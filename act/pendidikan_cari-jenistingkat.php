
<?php
require '../inc/koneksi.php';

$tingkat = $_GET["type"];

$querysearch = " 	SELECT educational_building_id, name_of_educational_building, ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) AS latitude
					FROM educational_building 
                    WHERE id_level_of_education = '$tingkat' ORDER BY name_of_educational_building
				";

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