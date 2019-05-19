<?php
include ('inc/koneksi.php');
$sql=pg_query("SELECT * FROM msme_building");
while ($data=pg_fetch_assoc($sql)) {
	$id=$data['msme_building_id'];
	$sql2=pg_query("SELECT *, st_area(geom) AS bang FROM house_building WHERE house_building_id='$id'");
	while ($dataa=pg_fetch_assoc($sql2)) {
		echo $id_bang = $dataa['house_building_id'];
		$model = $dataa['model_id']; if (is_null($model)) {$model="null";}
		$sql4 = pg_query("UPDATE msme_building SET
				model_id = $model
				WHERE msme_building_id = '$id_bang'
			");
		if ($sql4){
			echo "sukses<br>";
		}
		else {
			echo "gagal<br>";
		}
	}
}
?>