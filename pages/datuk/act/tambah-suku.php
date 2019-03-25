<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['suku'] != null ) {
		include ('../../../inc/koneksi.php');
		$result = pg_query("SELECT MAX(tribe_id) AS id FROM tribe");
	    $row = pg_fetch_array($result);
	    $id = $row["id"];
	    $id2 = $id+1;
		$suku = $_POST['suku'];
		$sql = pg_query("INSERT INTO tribe (tribe_id, name_of_tribe) VALUES ('$id2', '$suku')");
	}
?>