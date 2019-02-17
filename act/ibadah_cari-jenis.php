
<?php
require '../inc/koneksi.php';

$jenis = $_GET["type"];

$querysearch = " 	SELECT worship_building_id, name_of_worship_building ,ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) As latitude
					FROM worship_building 
                    WHERE type_of_worship = '$jenis' order by name_of_worship_building
				";

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