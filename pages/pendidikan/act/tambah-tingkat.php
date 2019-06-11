<?php
session_start();
if(isset($_SESSION['username']) && $_POST['tingkat'] != null ) {
	include ('../../../inc/koneksi.php');
	$result = pg_query("SELECT level_id AS id FROM level_of_education");
    $id=0;
	while ($data=pg_fetch_assoc($result)) {
		echo $temp=str_replace("L", "", $data["id"]);
		if ($id<$temp) {
			$id=$temp;
		}
	}
    $id = $id+1;
    if ($id<10) {
    	$id2="L0".$id;
    }
    else {
    	$id2="L".$id;
    }
	$jenis = $_POST['tingkat'];
	$sql = pg_query("INSERT INTO level_of_education (level_id, name_of_level) VALUES ('$id2', '$jenis')");
}
?>