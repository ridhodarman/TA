<?php
session_start();
if(isset($_SESSION['username']) && $_POST['id'] != null ) {
	include ('../../../inc/koneksi.php');
	include ('../../inc/notif-act.php');
	$id = $_POST['id'];
	$id_temp = $_POST['id-temp'];
	$nama = $_POST['nama'];
	$type= $_POST['jenis-s'];
	$cons = $_POST['konstruksi'];
	$lbang = $_POST['lbang']; if (empty($_POST['lbang'])) {$lbang = "0"; }
	$land = $_POST['lahan']; if (empty($_POST['lahan'])) {$land = "0"; }
	$parkir = $_POST['parkir']; if (empty($_POST['parkir'])) {$parkir = "0"; }
	$elect = $_POST['listrik']; if (empty($_POST['listrik'])) {$elect = "0"; }
	$alamat = $_POST['alamat'];
	$year = $_POST['tahun']; if (empty($_POST['tahun'])) {$year = "0"; }
	$murid = $_POST['murid']; if (empty($_POST['murid'])) {$murid = "0"; }
	$guru = $_POST['guru']; if (empty($_POST['guru'])) {$guru = "0"; }
	$kepala = $_POST['kepala'];
	$level = $_POST['level'];
	$model = $_POST['model'];
			
	$sql = pg_query("UPDATE educational_building SET
					educational_building_id = '$id', 
					name_of_educational_building = '$nama', 
					headmaster_name = '$kepala', 
					total_students = '$murid', 
					total_teachers = '$guru', 
					school_type = '$type', 
					id_level_of_education = '$level', 
					standing_year = '$year', 
					building_area = '$lbang', 
					land_area = '$land', 
					parking_area = '$parkir', 
					electricity_capacity = '$elect', 
					type_of_construction = '$cons', 
					address = '$alamat',
					model = '$model' 
					WHERE educational_building_id = '$id_temp'");


	if ($sql){
		echo '<script>
			$("#sukses").modal("show");
			</script>
			<meta http-equiv="REFRESH" content="1;url=../info-b-pendidikan.php?id='.$id.'">
			';
	}
	else {
		echo '<script>
			$("#gagal").modal("show");
			</script>
			<meta http-equiv="REFRESH" content="1;url=../info-b-pendidikan.php?id='.$id_temp.'">
			';
	}
}
else {
	echo '<script>window.location="../../../assets/403"</script>';
}
	


?>