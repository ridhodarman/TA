<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['fasilitas'] != null ) {

		include ('../../../inc/koneksi.php');

		$result = pg_query("SELECT MAX(facility_id) AS id FROM msme_building_facilities");
	    $row = pg_fetch_array($result);
	    $id = $row["id"];
	    $id2 = $id+1;

		$fas = $_POST['fasilitas'];

		$sql = pg_query("INSERT INTO msme_building_facilities (facility_id, name_of_facility) VALUES ('$id2', '$fas')");
	}

	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>