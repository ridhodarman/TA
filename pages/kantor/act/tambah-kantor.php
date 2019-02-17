<?php
session_start();
if(isset($_SESSION['username']) && $_POST['id'] != null ) {
	include ('../../../inc/koneksi.php');
	include ('../../inc/notif-act.php');
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
			
	$sql = pg_query("INSERT INTO office_building (office_building_id, name_of_office_building, type_of_office, building_area, land_area, parking_area, standing_year, electricity_capacity, type_of_construction, address, geom) 
		VALUES ('$id', '$nama', '$type', '$lbang', '$land', '$parkir', '$year', '$elect', '$cons', '$alamat', ST_GeomFromText('$geom'))");


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