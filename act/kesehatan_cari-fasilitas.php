<?php
require '../inc/koneksi.php';

$fas=$_GET['fas'];
$fas = explode(",", $fas);
$f = "";
$total = count($fas);
for($i=0;$i<$total;$i++){
	if($i == $total-1){
		$f .= "'".$fas[$i]."'";
	}else{
		$f .= "'".$fas[$i]."',";
	}
}
$querysearch="	SELECT H.health_building_id, H.name_of_health_building, ST_X(ST_Centroid(H.geom)) AS lng, ST_Y(ST_CENTROID(H.geom)) AS lat 
				FROM health_building AS H 
				JOIN detail_health_building_facilities AS F on H.health_building_id=F.health_building_id 
				WHERE F.facility_id IN ($f) GROUP BY F.health_building_id, H.health_building_id, H.name_of_health_building
				HAVING COUNT(*) = '$total'";
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		$id=$row['health_building_id'];
		$name=$row['name_of_health_building'];
		$longitude=$row['lng'];
		$latitude=$row['lat'];

		$dataarray[]=array('id'=>$id,'name'=>$name,'longitude'=>$longitude,'latitude'=>$latitude);
	}
echo json_encode ($dataarray);
?>