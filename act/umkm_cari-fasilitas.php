<?php
require '../inc/koneksi.php';


// $fas=$_GET['fas'];
// $fas = explode(",", $fas);
// $f = "";
// for($i=0;$i<count($fas);$i++){
// 	if($i == count($fas)-1){
// 		$f .= "'".$fas[$i]."'";
// 	}else{
// 		$f .= "'".$fas[$i]."',";
// 	}
// }
// $querysearch="	SELECT M.msme_building_id, M.name_of_msme_building, ST_X(ST_Centroid(M.geom)) AS lng, ST_Y(ST_CENTROID(M.geom)) AS lat FROM msme_building AS M 
// 			JOIN detail_msme_building_facilities AS F on M.msme_building_id=F.msme_building_id WHERE F.facility_id IN ($f) GROUP BY F.msme_building_id, M.msme_building_id, M.name_of_msme_building";
// $hasil=pg_query($querysearch);
// while($row = pg_fetch_array($hasil))
// 	{
// 		$id=$row['id'];
// 		$name=$row['name'];
// 		$longitude=$row['lng'];
// 		$latitude=$row['lat'];

// 		$dataarray[]=array('id'=>$id,'name'=>$name,'longitude'=>$longitude,'latitude'=>$latitude);
// 	}
// echo json_encode ($dataarray);

$fas=$_GET['fas'];
$fas = explode(",", $fas);
$f = "";
for($i=0;$i<count($fas);$i++){
	if($i == count($fas)-1){
		$f .= "'".$fas[$i]."'";
	}else{
		$f .= "'".$fas[$i]."',";
	}
}
$querysearch="	SELECT M.msme_building_id, M.name_of_msme_building, ST_X(ST_Centroid(M.geom)) AS lng, ST_Y(ST_CENTROID(M.geom)) AS lat 
				FROM msme_building AS M 
				JOIN detail_msme_building_facilities AS F on M.msme_building_id=F.msme_building_id 
				WHERE F.facility_id IN ($f) GROUP BY F.msme_building_id, M.msme_building_id, M.name_of_msme_building";
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		$id=$row['msme_building_id'];
		$name=$row['name_of_msme_building'];
		$longitude=$row['lng'];
		$latitude=$row['lat'];

		$dataarray[]=array('id'=>$id,'name'=>$name,'longitude'=>$longitude,'latitude'=>$latitude);
	}
echo json_encode ($dataarray);
?>