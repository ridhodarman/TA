<?php
session_start();
if(isset($_SESSION['username']) && $_POST['id'] != null ) {
	include ('../../../inc/koneksi.php');
	include ('../../inc/notif-act.php');
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$type= $_POST['jenis'];
	$cons = $_POST['konstruksi'];
	$lbang = $_POST['lbang']; if (empty($_POST['lbang'])) {$lbang = "0"; }
	$land = $_POST['lahan']; if (empty($_POST['lahan'])) {$land = "0"; }
	$parkir = $_POST['parkir']; if (empty($_POST['parkir'])) {$parkir = "0"; }
	$elect = $_POST['listrik']; if (empty($_POST['listrik'])) {$elect = "0"; }
	$alamat = $_POST['alamat'];
	$year = $_POST['tahun']; if (empty($_POST['tahun'])) {$year = "0"; }
	$geom = $_POST['geom'];
	$model = $_POST['model'];
			
	$sql = pg_query("INSERT INTO office_building (office_building_id, name_of_office_building, type_of_office, building_area, land_area, parking_area, standing_year, electricity_capacity, type_of_construction, address, geom, model_id) 
		VALUES ('$id', '$nama', '$type', '$lbang', '$land', '$parkir', '$year', '$elect', '$cons', '$alamat', ST_GeomFromText('$geom'), '$model')");

	if ($sql){
		echo '<script>
			$("#sukses").modal("show");
			</script>
			<meta http-equiv="REFRESH" content="1;url=../info-kantor.php?id='.$id.'">
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