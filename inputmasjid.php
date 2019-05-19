<?php
include ('inc/koneksi.php');
$sql=pg_query("SELECT * FROM worship_building");
while ($data=pg_fetch_assoc($sql)) {
	$id=$data['worship_building_id'];
	$sql2=pg_query("SELECT *, st_area(geom) AS bang FROM house_building WHERE house_building_id='$id'");
	while ($dataa=pg_fetch_assoc($sql2)) {
		echo $id_bang = $dataa['house_building_id'];
		$alamat = $dataa['address'];
		$kons = $dataa['type_of_construction']; if (is_null($kons)||$kons==0) {$kons="null";}
		$bang = $dataa['bang']*10000000000;
		$lahan = $dataa['bang']*10000000000+20;
		$geom = $dataa['geom'];
		$parkir = 20;
		$elec = $dataa['electricity_capacity']; if (is_null($elec)) {$elec="null";}
		$tahun = $dataa['standing_year']; if (is_null($tahun)) {$tahun="null";}
		$sql4 = pg_query("UPDATE worship_building SET
				address = '$alamat',
				type_of_construction = $kons,
				building_area = $bang,
				land_area = $lahan,
				parking_area = $parkir,
				electricity_capacity = $elec,
				standing_year = $tahun,
				geom = '$geom'
				WHERE worship_building_id = '$id_bang'
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