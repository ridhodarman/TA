<?php
session_start();
if(isset($_SESSION['username']) && $_POST['id'] != null ) {
	include ('../../../inc/koneksi.php');
	include ('../../inc/notif-act.php');
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$type= $_POST['jenis-s'];
	$cons = $_POST['konstruksi'];
	$lbang = $_POST['lbang']; if (empty($_POST['lbang'])) {$lbang = "0"; }
	$land = $_POST['lahan']; if (empty($_POST['lahan'])) {$land = "0"; }
	$parkir = $_POST['parkir']; if (empty($_POST['parkir'])) {$parkir = "0"; }
	$elect = $_POST['listrik']; if (empty($_POST['listrik'])) {$elect = "0"; }
	$alamat = $_POST['alamat'];
	$year = $_POST['tahun']; if (empty($_POST['tahun'])) {$year = "0"; }
	$geom = $_POST['geom'];
	$murid = $_POST['murid']; if (empty($_POST['murid'])) {$murid = "0"; }
	$guru = $_POST['guru']; if (empty($_POST['guru'])) {$guru = "0"; }
	$kepala = $_POST['kepala'];
	$level = $_POST['level'];
	$model = $_POST['model'];
			
	$sql = pg_query("INSERT INTO educational_building (educational_building_id, name_of_educational_building, headmaster_name, total_students, total_teachers, school_type, id_level_of_education, standing_year, building_area, land_area, parking_area, electricity_capacity, type_of_construction, address, geom, model_id) 
		VALUES ('$id', '$nama', '$kepala', '$murid', '$guru', '$type', '$level', '$year', '$lbang', '$land', '$parkir', '$elect', '$cons', '$alamat', ST_GeomFromText('$geom'), '$model')");

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
			<meta http-equiv="REFRESH" content="1;url=../">
			';
	}
}
else {
	echo '<script>window.location="../../../assets/403"</script>';
}
	
?>