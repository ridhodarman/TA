<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['id-bang'] != null) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id_bang = $_POST['id-bang'];
		$id_fas = $_POST['id-fas'];
		$qty = $_POST['total-fas-edit'];
		$sql = pg_query("UPDATE detail_educational_building_facilities SET 
						quantity_of_facilities = '$qty'
						WHERE educational_building_id = '$id_bang' and facility_id = '$id_fas'");
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
		echo '<meta http-equiv="REFRESH" content="1;url=../info-b-pendidikan.php?id='.$id_bang.'">';
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>