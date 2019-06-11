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
$querysearch="	SELECT O.office_building_id, O.name_of_office_building, ST_X(ST_Centroid(O.geom)) AS lng, ST_Y(ST_CENTROID(O.geom)) AS lat 
				FROM office_building AS O
				JOIN detail_office_building_facilities AS F on O.office_building_id=F.office_building_id 
				WHERE F.facility_id IN ($f) GROUP BY F.office_building_id, O.office_building_id, O.name_of_office_building
				HAVING COUNT(*) = '$total'";
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		$id=$row['office_building_id'];
		$name=$row['name_of_office_building'];
		$longitude=$row['lng'];
		$latitude=$row['lat'];

		$dataarray[]=array('id'=>$id,'name'=>$name,'longitude'=>$longitude,'latitude'=>$latitude);
	}
echo json_encode ($dataarray);
?>