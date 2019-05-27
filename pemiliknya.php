<?php

include ('inc/koneksi.php');
$sql=pg_query("SELECT * FROM pemilik where nama != '' order by nama");
while ($data=pg_fetch_assoc($sql)) {
	echo $nama=strtoupper($data['nama']);
	$idrumah=$data['id'];
	$sql2=pg_query("SELECT * FROM citizen WHERE upper(name)='$nama'");
	while ($dataaa=pg_fetch_assoc($sql2)) {
		$nik=$dataaa['national_identity_number'];
	}
	if(pg_num_rows($sql2)==0){
		echo "<p>cari kemiripan</p>";
		$sql3=pg_query("SELECT * FROM citizen WHERE upper(name) like '%$nama%'");
		if(pg_num_rows($sql3)>0){
			echo "<p>ada yang mirip</p>";
			while ($dataa=pg_fetch_assoc($sql3)) {
				$nik=$dataa['national_identity_number'];
			}
			$sql4 = pg_query("UPDATE house_building SET owner_id = '$nik' WHERE house_building_id = '$idrumah'");
			if ($sql4){
				echo $nik." pemilik ".$idrumah."<br>";
			}
		}
	}
	else {
		echo "<p>identik</p>";
		$sql6 = pg_query("UPDATE house_building SET owner_id = '$nik' WHERE house_building_id = '$idrumah'");
		if ($sql6){
			echo $nik." pemilik ".$idrumah."<br>";
		}
	}
}
?>