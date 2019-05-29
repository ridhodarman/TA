<?php
session_start();
if(isset($_SESSION['username']) && $_POST['id'] != null ) {
	include ('../../../inc/koneksi.php');
	include ('../../inc/notif-act.php');
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$type= $_POST['j-kes'];
	$cons = $_POST['konstruksi'];
	$lbang = $_POST['lbang']; if (empty($_POST['lbang'])) {$lbang = "0"; }
	$land = $_POST['lahan']; if (empty($_POST['lahan'])) {$land = "0"; }
	$parkir = $_POST['parkir']; if (empty($_POST['parkir'])) {$parkir = "0"; }
	$elect = $_POST['listrik']; if (empty($_POST['listrik'])) {$elect = "0"; }
	$alamat = $_POST['alamat'];
	$year = $_POST['tahun']; if (empty($_POST['tahun'])) {$year = "0"; }
	$geom = $_POST['geom'];
	$kepala = $_POST['kepala'];
	$medis = $_POST['medis']; if (empty($_POST['medis'])) {$medis = "0"; }
	$non = $_POST['non']; if (empty($_POST['non'])) {$non = "0"; }
	$model = $_POST['model'];
			
	$sql = pg_query("INSERT INTO health_building (health_building_id, name_of_health_building, type_of_health_building, building_area, land_area, parking_area, standing_year, electricity_capacity, type_of_construction, address, name_of_head, number_of_medical_personnel, number_of_nonmedical_personnel, geom, model_id) 
		VALUES ('$id', '$nama', '$type', '$lbang', '$land', '$parkir', '$year', '$elect', '$cons', '$alamat', '$kepala', '$medis', '$non', ST_GeomFromText('$geom'), '$model')");

	if ($sql){
		echo '<script>
			$("#sukses").modal("show");
			</script>
			<meta http-equiv="REFRESH" content="1;url=../info-b-kesehatan.php?id='.$id.'">
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