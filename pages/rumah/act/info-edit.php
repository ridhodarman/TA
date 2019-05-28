<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['id-temp'] != null) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id = $_POST['id'];
		$id_temp = $_POST['id-temp'];
		$year = $_POST['tahun'];
		$pbb = $_POST['pbb'];
		$cons = $_POST['konstruksi'];
		$lbang = $_POST['lbang'];
		$land = $_POST['lahan'];
		$elect = $_POST['listrik'];
		$tap = $_POST['water'];
		$status = $_POST['status'];
		$address = $_POST['alamat'];
		$owner = $_POST['pemilik'];
		$geom = $_POST['geom'];
		$model = $_POST['model'];

		$sql = pg_query("UPDATE house_building SET 
						house_building_id = '$id', 
						address = '$address', 
						standing_year = '$year', 
						land_building_tax = '$pbb', 
						type_of_construction = '$cons', 
						electricity_capacity = '$elect', 
						tap_water = '$tap', 
						building_status = '$status',
						model_id = '$model'
						WHERE house_building_id = '$id_temp'");

		if ($sql){
			echo '<script>
				$("#updated").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-rumah.php?id='.$id.'">
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-rumah.php?id='.$id_temp.'">
				';
		}
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>