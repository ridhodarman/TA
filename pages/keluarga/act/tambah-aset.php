<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['aset2'] != null ) {
		include ('../../../inc/koneksi.php');
		$result = pg_query("SELECT MAX(asset_id) AS id FROM asset");
	    $row = pg_fetch_array($result);
	    $id = $row["id"];
	    $id2 = $id+1;
		$a = $_POST['aset2'];

		$sql = pg_query("INSERT INTO asset (asset_id, name_of_asset) VALUES ('$id2', '$a')");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>