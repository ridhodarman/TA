<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['tingkat'] != null ) {
		include ('../../../inc/koneksi.php');
		$result = pg_query("SELECT MAX(level_id) AS id FROM level_of_education");
	    $row = pg_fetch_array($result);
	    $id = $row["id"];
	    $id2 = $id+1;
		$jenis = $_POST['tingkat'];

		$sql = pg_query("INSERT INTO level_of_education (level_id, name_of_level) VALUES ('$id2', '$jenis')");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>