<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['pend'] != null ) {
		include ('../../../inc/koneksi.php');
		$result = pg_query("SELECT education_id AS id FROM education");
		$id=0;
		while ($data=pg_fetch_assoc($result)) {
			echo $temp=str_replace("E", "", $data["id"]);
			if ($id<$temp) {
				$id=$temp;
			}
		}
	    $id = $id+1;
	    if ($id<10) {
	    	$id2="E0".$id;
	    }
	    else {
	    	$id2="E".$id;
	    }
		$pend = $_POST['pend'];
		$sql = pg_query("INSERT INTO education (education_id, educational_level) VALUES ('$id2', '$pend')");
	}
?>