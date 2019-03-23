<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['penghuni'] != null) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id_bang = $_POST['id-bang2'];
		$penghuni = $_POST['penghuni'];
		$sql = pg_query("UPDATE householder SET 
						house_building_id = '$id_bang'
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