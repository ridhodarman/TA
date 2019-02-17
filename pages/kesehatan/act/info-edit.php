<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['id-temp'] != null) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id = $_POST['id'];
		$id_temp = $_POST['id-temp'];
		$nama = $_POST['nama'];
		$type= $_POST['j-kes'];
		$cons = $_POST['konstruksi'];
		$lbang = $_POST['lbang'];
		$land = $_POST['lahan'];
		$parkir = $_POST['parkir'];
		$elect = $_POST['listrik'];
		$alamat = $_POST['alamat'];
		$year = $_POST['tahun'];
		$kepala = $_POST['kepala'];
		$medis = $_POST['medis'];
		$non = $_POST['non'];
		$sql = pg_query("UPDATE health_building SET
						health_building_id = '$id', 
						name_of_health_building = '$nama', 
						type_of_health_services = '$type', 
						building_area = '$lbang', 
						land_area = '$land', 
						parking_area = '$parkir', 
						standing_year = '$year', 
						electricity_capacity = '$elect', 
						type_of_construction = '$cons', 
						address = '$alamat', 
						name_of_head = '$kepala', 
						number_of_medical_personnel = '$medis', 
						number_of_nonmedical_personnel = '$non'
						WHERE health_building_id = '$id_temp'");
		if ($sql){
			echo '<script>
				$("#updated").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-b-kesehatan.php?id='.$id.'">
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-b-kesehatan.php?id='.$id_temp.'">
				';
		}
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>