<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['jenis'] != null ) {
		include ('../../../inc/koneksi.php');
		$result = pg_query("SELECT type_id AS id FROM type_of_worship");
	    $id=0;
		while ($data=pg_fetch_assoc($result)) {
			echo $temp=str_replace("W", "", $data["id"]);
			if ($id<$temp) {
				$id=$temp;
			}
		}
	    $id = $id+1;
	    if ($id<10) {
	    	$id2="W0".$id;
	    }
	    else {
	    	$id2="W".$id;
	    }
		$jenis = $_POST['jenis'];
		$sql = pg_query("INSERT INTO type_of_worship (type_id, name_of_type) VALUES ('$id2', '$jenis')");
	}
?>