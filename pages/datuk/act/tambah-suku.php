<?php
session_start();
if(isset($_SESSION['username']) && $_POST['suku'] != null ) {
	include ('../../../inc/koneksi.php');
	$result = pg_query("SELECT MAX(tribe_id) AS id FROM tribe");
    $id=0;
	while ($data=pg_fetch_assoc($result)) {
		echo $temp=str_replace("T", "", $data["id"]);
		if ($id<$temp) {
			$id=$temp;
		}
	}
    $id = $id+1;
    if ($id<10) {
    	$id2="T0".$id;
    }
    else {
    	$id2="T".$id;
    }
	$suku = $_POST['suku'];
	$sql = pg_query("INSERT INTO tribe (tribe_id, name_of_tribe) VALUES ('$id2', '$suku')");
}
?>