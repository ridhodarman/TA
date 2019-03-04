<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['id-bang'] != null) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id_bang = $_POST['id-bang'];
		$geom = $_POST['geom'];
		$sql = pg_query("UPDATE worship_building SET 
						geom = ST_GeomFromText('$geom')
						WHERE worship_building_id = '$id_bang'");
		if ($sql){
			echo '<script>
				$("#updated").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-b-ibadah.php?id='.$id_bang.'">
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-b-ibadah.php?id='.$id_bang.'">
				';
		}
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>