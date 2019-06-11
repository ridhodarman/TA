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
$querysearch="	SELECT M.worship_building_id, M.name_of_worship_building, ST_X(ST_Centroid(M.geom)) AS lng, ST_Y(ST_CENTROID(M.geom)) AS lat 
				FROM worship_building AS M 
				JOIN detail_worship_building_facilities AS F ON M.worship_building_id=F.worship_building_id 
				WHERE F.facility_id IN ($f) GROUP BY F.worship_building_id, M.worship_building_id, M.name_of_worship_building
				HAVING COUNT(*) = '$total' ";
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		$id=$row['worship_building_id'];
		$name=$row['name_of_worship_building'];
		$longitude=$row['lng'];
		$latitude=$row['lat'];

		$dataarray[]=array('id'=>$id,'name'=>$name,'longitude'=>$longitude,'latitude'=>$latitude);
	}
echo json_encode ($dataarray);
?>