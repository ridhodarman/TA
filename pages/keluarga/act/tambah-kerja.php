<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['kerja2'] != null ) {
		include ('../../../inc/koneksi.php');
		$result = pg_query("SELECT job_id AS id FROM job");
	    $id=0;
		while ($data=pg_fetch_assoc($result)) {
			echo $temp=str_replace("P", "", $data["id"]);
			if ($id<$temp) {
				$id=$temp;
			}
		}
	    $id = $id+1;
	    if ($id<10) {
	    	$id2="P0".$id;
	    }
	    else {
	    	$id2="P".$id;
	    }
		$k = $_POST['kerja2'];

		$sql = pg_query("INSERT INTO job (job_id, job_name) VALUES ('$id2', '$k')");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>