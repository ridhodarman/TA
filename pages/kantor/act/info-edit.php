<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['id-temp'] != null) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id_temp = $_POST['id-temp'];
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$type= $_POST['jenis'];
		$cons = $_POST['konstruksi'];
		$lbang = $_POST['lbang'];
		$land = $_POST['lahan'];
		$parkir = $_POST['parkir'];
		$elect = $_POST['listrik'];
		$alamat = $_POST['alamat'];
		$year = $_POST['tahun'];
		$geom = $_POST['geom'];
				
		$sql = pg_query("UPDATE office_building SET 
			office_building_id = '$id', 
			name_of_office_building = '$nama', 
			type_of_office = '$type', 
			building_area = '$lbang', 
			land_area = '$land', 
			parking_area = '$parkir', 
			standing_year = '$year', 
			electricity_capacity = '$elect', 
			type_of_construction = '$cons', 
			address = '$alamat'
			WHERE office_building_id = '$id_temp'");
		if ($sql){
			echo '<script>
				$("#updated").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-kantor.php?id='.$id.'">
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-kantor.php?id='.$id_temp.'">
				';
		}
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>