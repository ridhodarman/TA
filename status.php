<?php
include ('inc/koneksi.php');
$sql=pg_query("SELECT * FROM citizen");
while ($data=pg_fetch_assoc($sql)) {
	$nik=str_replace(".", "", $data['national_identity_number']);
	$sql2=pg_query("SELECT * FROM penduduk WHERE nik='$nik'");
	while ($dataa=pg_fetch_assoc($sql2)) {
		$nik_p = $dataa['nik'];
		$kk = $dataa['no_kk'];
		$status = $dataa['stat_hbkel'];
		echo $s = strtolower( str_replace(" ", "", $status) );
		if ($s=="kepalakeluarga") {
			$stat=1;
			echo $nik_p;
		}
		else if ($s=="isteri") {
			$stat=2;
			echo $nik_p;
		}
		else if ($s=="anak") {
			$stat=3;
			echo $nik_p;
		}
		else if ($s=="famililain") {
			$stat=4;
			echo $nik_p;
		}
		else if ($s=="istri") {
			$stat=3;
			echo $nik_p;
		}
		else if ($s=="") {
			$stat=0;
			echo $nik_p;
		}
		else {
			$stat=4;
			echo $nik_p;
		}
		echo "<br>";
		$sql4 = pg_query("UPDATE citizen SET status_in_family='$stat', family_card_number='$kk' WHERE national_identity_number='$nik_p'");
		if ($sql4){
			echo "sukses<br>";
		}
		else {
			echo "gagal<br>";
			$sql5=pg_query("INSERT INTO family_card (family_card_number) VALUES ('$kk')");
			if ($sql5) {
				echo "kk ditambahkan";
			}
		}
	}
}
?>