<?php
include ('inc/koneksi.php');
$sql=pg_query("SELECT * FROM msme_building");
while ($data=pg_fetch_assoc($sql)) {
	$id=$data['msme_building_id'];
	$sql2=pg_query("SELECT * FROM house_building_gallery WHERE house_building_id='$id'");
	while ($dataa=pg_fetch_assoc($sql2)) {
		echo $id_bang = $dataa['house_building_id'];
		$url = $dataa['photo_url'];
		$tgl = $dataa['upload_date'];
		$sql4 = pg_query("INSERT INTO msme_building_gallery (msme_building_id, photo_url, upload_date) VALUES ('$id_bang', '$url', '$tgl')");
		if ($sql4){
			echo "sukses<br>";
		}
		else {
			echo "gagal<br>";
		}
	}
}
?>