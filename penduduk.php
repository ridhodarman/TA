<?php

include ('inc/koneksi.php');
$sql=pg_query("SELECT * FROM householder order by head_of_family");
while ($data=pg_fetch_assoc($sql)) {
	echo $nama=strtoupper(str_replace("'", " ", $data['head_of_family']));
	$fcn=$data['family_card_number'];
	$sql2=pg_query("SELECT * FROM penduduk WHERE upper(nama_lgkp)='$nama'");
	while ($dataaa=pg_fetch_assoc($sql2)) {
		$nik=$dataaa['nik'];
	}
	if(pg_num_rows($sql2)==0){
		echo "<p>cari kemiripan</p>";
		$sql3=pg_query("SELECT * FROM penduduk WHERE upper(nama_lgkp) like '%$nama%'");
		if(pg_num_rows($sql3)>0){
			echo "<p>ada yang mirip</p>";
			while ($dataa=pg_fetch_assoc($sql3)) {
				$nik=$dataa['nik'];
			}
			$sql4 = pg_query("UPDATE householder SET national_identity_number = '$nik' WHERE family_card_number = '$fcn'");
			if ($sql4){
				echo $nik."<br>";
			}
			else {
				$nik=$nik.".";
				$sql5 = pg_query("UPDATE householder SET national_identity_number = '$nik' WHERE family_card_number = '$fcn'");
				if ($sql5){
					echo $nik."edit1<br>";
				}
				else{
					echo $nik2=$nik."..";
					$sql9 = pg_query("UPDATE householder SET national_identity_number = '$nik2' WHERE family_card_number = '$fcn'");
				}
			}
		}
	}
	else {
		echo "<p>identik</p>";
		$sql6 = pg_query("UPDATE householder SET national_identity_number = '$nik' WHERE family_card_number = '$fcn'");
		if ($sql6){
			echo $nik."<br>";
		}
		else {
			echo "identik gagal<p>";
			$nik2=$nik.".";
			$sql7 = pg_query("UPDATE householder SET national_identity_number = '$nik2' WHERE family_card_number = '$fcn'");
			if ($sql7){
				echo $nik2."edit2<br>";
			}
			else{
				echo $nik2=$nik."..";
				$sql8 = pg_query("UPDATE householder SET national_identity_number = '$nik2' WHERE family_card_number = '$fcn'");
			}
		}
	}
}
?>