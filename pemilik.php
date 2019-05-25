<?php

include ('inc/koneksi.php');
$sql=pg_query("SELECT * FROM citizen order by name");
while ($data=pg_fetch_assoc($sql)) {
	echo $nama=strtoupper(str_replace("'", " ", $data['name']));
	$idn=$data['national_identity_number'];
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
			$sql4 = pg_query("UPDATE citizen SET national_identity_number = '$nik' WHERE national_identity_number = '$idn'");
			if ($sql4){
				echo $nik."<br>";
			}
			else {
				$nik=$nik.".";
				$sql5 = pg_query("UPDATE citizen SET national_identity_number = '$nik' WHERE national_identity_number = '$idn'");
				if ($sql5){
					echo $nik."edit1<br>";
				}
				else{
					echo $nik2=$nik."..";
					$sql9 = pg_query("UPDATE citizen SET national_identity_number = '$nik2' WHERE national_identity_number = '$idn'");
					if ($sql9){
						echo $nik."edit2<br>";
					}
					else{
						echo $nik2=$nik."...";
						$sql10 = pg_query("UPDATE citizen SET national_identity_number = '$nik2' WHERE national_identity_number = '$idn'");
					}
				}
			}
		}
	}
	else {
		echo "<p>identik</p>";
		$sql6 = pg_query("UPDATE citizen SET national_identity_number = '$nik' WHERE national_identity_number = '$idn'");
		if ($sql6){
			echo $nik."<br>";
		}
		else {
			echo "identik gagal<p>";
			$nik2=$nik.".";
			$sql7 = pg_query("UPDATE citizen SET national_identity_number = '$nik2' WHERE national_identity_number = '$idn'");
			if ($sql7){
				echo $nik2."edit2<br>";
			}
			else{
				echo $nik2=$nik."..";
				$sql8 = pg_query("UPDATE citizen SET national_identity_number = '$nik2' WHERE national_identity_number = '$idn'");
				if ($sql8){
				echo $nik2."edit3<br>";
				}
				else{
					echo $nik2=$nik."...";
					$sql18 = pg_query("UPDATE citizen SET national_identity_number = '$nik2' WHERE national_identity_number = '$idn'");
				}
			}
		}
	}
}
?>