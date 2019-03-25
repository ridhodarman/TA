<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['nama'] != null ) {
		include ('../../../inc/koneksi.php');
		$result = pg_query("SELECT MAX(datuk_id) AS id FROM datuk");
	    $row = pg_fetch_array($result);
	    $id = $row["id"];
	    $id2 = $id+1;
		$nama = $_POST['nama'];
		$suku = $_POST['suku'];
		$sql = pg_query("INSERT INTO datuk (datuk_id, datuk_name, tribe_id) VALUES ('$id2', '$nama', '$suku')");
	}
?>