<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['pend'] != null ) {
		include ('../../../inc/koneksi.php');
		$result = pg_query("SELECT MAX(education_id) AS id FROM education");
	    $row = pg_fetch_array($result);
	    $id = $row["id"];
	    $id2 = $id+1;
		$pend = $_POST['pend'];

		$sql = pg_query("INSERT INTO education (education_id, educational_level) VALUES ('$id2', '$pend')");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>