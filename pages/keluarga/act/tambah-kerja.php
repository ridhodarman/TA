<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['kerja2'] != null ) {
		include ('../../../inc/koneksi.php');
		$result = pg_query("SELECT MAX(job_id) AS id FROM job");
	    $row = pg_fetch_array($result);
	    $id = $row["id"];
	    $id2 = $id+1;
		$k = $_POST['kerja2'];

		$sql = pg_query("INSERT INTO job (job_id, job_name) VALUES ('$id2', '$k')");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>