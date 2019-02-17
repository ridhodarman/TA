<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id_bang = $_GET['id-bang'];
		$id_fas = $_GET['id-fas'];
		$sql = pg_query("DELETE FROM detail_msme_building_facilities WHERE msme_building_id = '$id_bang' and facility_id = '$id_fas'");
		if ($sql){
			echo '<script>
				$("#hapus").modal("show");
				</script>
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				';
		}
		echo '<meta http-equiv="REFRESH" content="1;url=../info-umkm.php?id='.$id_bang.'">';
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>