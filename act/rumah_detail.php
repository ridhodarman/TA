<?php
require '../inc/koneksi.php';
$cari = $_GET["cari"];
$querysearch ="SELECT H.house_building_id, ST_X(ST_Centroid(H.geom)) AS lng, ST_Y(ST_CENTROID(H.geom)) AS lat, G.photo_url
				FROM house_building AS H
				LEFT JOIN house_building_gallery AS G on H.house_building_id=G.house_building_id 
				WHERE H.house_building_id='$cari' ORDER BY G.upload_date DESC LIMIT 1";	   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		  $id=$row['house_building_id'];
		  $name=$row['house_building_id'];
		  $longitude=$row['lng'];
		  $latitude=$row['lat'];
		  $image=$row['photo_url'];

		  $dataarray[]=array('id'=>$id,'name'=>$name, 'image'=>$image, 'longitude'=>$longitude,'latitude'=>$latitude);
	}
echo json_encode ($dataarray);
?>
