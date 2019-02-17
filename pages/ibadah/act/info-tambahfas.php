<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['id'] != null ) {

		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');

		$id = $_POST['id'];
		$fas = $_POST['fasilitas'];
		$total = $_POST['total-fas'];

		$sql = pg_query("INSERT INTO detail_worship_building_facilities (worship_building_id, facility_id, quantity_of_facilities) VALUES ('$id', '$fas', '$total')");
		if ($sql){
			echo '<script>
				$("#sukses").modal("show");
				</script>
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				';
		}
		echo '<meta http-equiv="REFRESH" content="1;url=../info-b-ibadah.php?id='.$id.'">';
	}

	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>