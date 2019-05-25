<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['kampung2'] != null ) {
		include ('../../../inc/koneksi.php');
		$result = pg_query("SELECT MAX(village_id) AS id FROM village");
	    $row = pg_fetch_array($result);
	    $id = $row["id"];
	    $id2 = $id+1;
		$k = $_POST['kampung2'];

		$sql = pg_query("INSERT INTO village (village_id, village_name) VALUES ('$id2', '$k')");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>