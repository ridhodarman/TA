<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['fasilitas'] != null ) {
		include ('../../../inc/koneksi.php');
		$result = pg_query("SELECT facility_id AS id FROM msme_building_facilities");
	    $id=0;
		while ($data=pg_fetch_assoc($result)) {
			echo $temp=str_replace("F", "", $data["id"]);
			if ($id<$temp) {
				$id=$temp;
			}
		}
	    $id = $id+1;
	    if ($id<10) {
	    	$id2="F0".$id;
	    }
	    else {
	    	$id2="F".$id;
	    }

		$fas = $_POST['fasilitas'];
		$sql = pg_query("INSERT INTO msme_building_facilities (facility_id, name_of_facility) VALUES ('$id2', '$fas')");
	}

	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>