<?php
require '../inc/koneksi.php';
$id = $_GET["id"];

$querysearch = "SELECT M.msme_building_id, M.name_of_msme_building, ST_X(ST_Centroid(M.geom)) AS lng, ST_Y(ST_CENTROID(M.geom)) AS lat, G.photo_url
                FROM msme_building AS M
                LEFT JOIN msme_building_gallery AS G on M.msme_building_id=G.msme_building_id 
                WHERE M.msme_building_id='$cari' ORDER BY G.upload_date DESC LIMIT 1";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['msme_building_id'];
    $name = $row['name_of_msme_building'];
    $longitude = $row['lng'];
    $latitude = $row['lat'];
    $image = $row['photo_url'];

    $dataarray[] = array('id' => $id, 'name' => $name, 'image' => $image, 'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);
