<?php

include ('inc/koneksi.php');
$sql=pg_query("SELECT * FROM house_building_owner order by national_identity_number");
while ($data=pg_fetch_assoc($sql)) {
	$idn=$data['national_identity_number'];
	$sql2=pg_query("SELECT * FROM penduduk WHERE upper(nik)='$idn'");
	while ($dataaa=pg_fetch_assoc($sql2)) {
		$kk=$dataaa['no_kk'];
	}
	if(pg_num_rows($sql2)==0){
		echo "<p>cari kemiripan</p>";
		$sql3=pg_query("SELECT * FROM penduduk WHERE upper(nik) like '%$idn%'");
		if(pg_num_rows($sql3)>0){
			echo "<p>ada yang mirip</p>";
			while ($dataa=pg_fetch_assoc($sql3)) {
				$kk=$dataa['no_kk'];
			}
			$sql4 = pg_query("UPDATE house_building_owner SET family_card_number = '$kk' WHERE national_identity_number = '$idn'");
			if ($sql4){
				echo $nik."<br>";
			}
			else {
				$nik=$nik.".";
				$sql5 = pg_query("UPDATE house_building_owner SET family_card_number = '$kk' WHERE national_identity_number = '$idn'");
				if ($sql5){
					echo $nik."edit1<br>";
				}
				else{
					echo $nik2=$nik."..";
					$sql9 = pg_query("UPDATE house_building_owner SET family_card_number = '$kk' WHERE national_identity_number = '$idn'");
				}
			}
		}
	}
	else {
		echo "<p>identik</p>";
		$sql6 = pg_query("UPDATE house_building_owner SET family_card_number = '$kk' WHERE national_identity_number = '$idn'");
		if ($sql6){
			echo $kk."<br>";
		}
		else {
			echo "identik gagal<p>";
			$kk2=$kk.".";
			$sql7 = pg_query("UPDATE house_building_owner SET family_card_number = '$kk2' WHERE national_identity_number = '$idn'");
			if ($sql7){
				echo $nik2."edit2<br>";
			}
			else{
				echo $kk2=$nik."..";
				$sql8 = pg_query("UPDATE house_building_owner SET family_card_number = '$kk2' WHERE national_identity_number = '$idn'");
			}
		}
	}
}
?>