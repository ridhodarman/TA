<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$penghuni = base64_decode($_GET['id']);
		$id_bang = $_GET['bang'];
		$sql = pg_query("UPDATE householder SET 
						house_building_id = null
						WHERE family_card_number = '$penghuni'");
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