<?php
session_start();
if(isset($_SESSION['username']) && $_POST['nama'] != null ) {
	include ('../../../inc/koneksi.php');
	$result = pg_query("SELECT MAX(datuk_id) AS id FROM datuk");
    $id=0;
	while ($data=pg_fetch_assoc($result)) {
		echo $temp=str_replace("D", "", $data["id"]);
		if ($id<$temp) {
			$id=$temp;
		}
	}
    $id = $id+1;
    if ($id<10) {
    	$id2="D0".$id;
    }
    else {
    	$id2="D".$id;
    }
	$nama = $_POST['nama'];
	$suku = $_POST['suku'];
	$sql = pg_query("INSERT INTO datuk (datuk_id, datuk_name, tribe_id) VALUES ('$id2', '$nama', '$suku')");
}
?>