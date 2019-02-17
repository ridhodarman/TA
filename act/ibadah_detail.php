<?php
require '../inc/koneksi.php';
$cari = $_GET["cari"];

$querysearch = "SELECT W.worship_building_id, W.name_of_worship_building, ST_X(ST_Centroid(W.geom)) AS lng, ST_Y(ST_CENTROID(W.geom)) AS lat, G.photo_url
                FROM worship_building AS W
                LEFT JOIN worship_building_gallery AS G on W.worship_building_id=G.worship_building_id 
                WHERE W.worship_building_id='$cari' ORDER BY G.upload_date DESC LIMIT 1";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['worship_building_id'];
    $name = $row['name_of_worship_building'];
    $longitude = $row['lng'];
    $latitude = $row['lat'];
    $image = $row['photo_url'];

    $dataarray[] = array('id' => $id, 'name' => $name, 'image' => $image, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
