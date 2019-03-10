<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['id-bang'] != null) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id_bang = $_POST['id-bang'];
		$owner = $_POST['pemilik'];
		$sql = pg_query("UPDATE house_building SET 
						fcn_owner = '$owner'
						WHERE house_building_id = '$id_bang'");
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

		echo '<meta http-equiv="REFRESH" content="1;url=../info-rumah.php?id='.$id_bang.'">';
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>