<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['id-bang'] != null) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id_bang = $_POST['id-bang'];
		$id_fas = $_POST['id-fas'];
		$qty = $_POST['total-fas-edit'];
		$sql = pg_query("UPDATE detail_worship_building_facilities SET 
						quantity_of_facilities = '$qty'
						WHERE worship_building_id = '$id_bang' and facility_id = '$id_fas'");
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