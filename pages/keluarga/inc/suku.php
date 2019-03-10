<?php
include('../../../inc/koneksi.php');
$datuk= $_GET['id_datuk'];
$tampil=pg_query("SELECT tribe_id FROM datuk WHERE datuk_id='$datuk'");
$jml=pg_num_rows($tampil);
if($jml > 0){
while($r=pg_fetch_array($tampil)){
	$idsuku= $r['tribe_id'];
	$sql=pg_query("SELECT name_of_tribe FROM tribe WHERE tribe_id='$idsuku'");
	$jml2=pg_num_rows($sql);
	if($jml2 > 0){
		while($h=pg_fetch_array($sql)){
			$suku = $h['name_of_tribe'];
			echo "Tribe: ".$suku;
		}
	}
}
}else{
    echo "Tribe: -";
}
?>