<?php
session_start();
if(isset($_SESSION['username']) && $_POST['id-bang'] != null) {
	include ('../../../inc/koneksi.php');
	include ('../../inc/notif-act.php');
	$id_bang = $_POST['id-bang'];
	$geom = $_POST['geom'];
	$sql = pg_query("UPDATE office_building SET 
					geom = ST_GeomFromText('$geom')
					WHERE office_building_id = '$id_bang'");
	if ($sql){
		echo '<script>
			$("#updated").modal("show");
			</script>
			';
	}
	else {
		echo '<script>
			$("#gagal").modal("show");
			</script>
			';
	}
	echo '<meta http-equiv="REFRESH" content="1;url=../info-kantor.php?id='.$id_bang.'">';
}
else {
	echo '<script>window.location="../../../assets/403"</script>';
}
?>