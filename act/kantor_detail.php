<?php
require '../inc/koneksi.php';
$cari = $_GET["cari"];

$querysearch = "SELECT W.office_building_id, W.name_of_office_building, ST_X(ST_Centroid(W.geom)) AS lng, ST_Y(ST_CENTROID(W.geom)) AS lat, G.photo_url
                FROM office_building AS W
                LEFT JOIN office_building_gallery AS G on W.office_building_id=G.office_building_id 
                WHERE W.office_building_id='$cari' ORDER BY G.upload_date DESC LIMIT 1";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['office_building_id'];
    $name = $row['name_of_office_building'];
    $longitude = $row['lng'];
    $latitude = $row['lat'];
    $image = $row['photo_url'];

    $dataarray[] = array('id' => $id, 'name' => $name, 'image' => $image, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
