<?php
session_start();
if(isset($_SESSION['username']) && $_POST['id'] != null ) {
	include ('../../../inc/koneksi.php');
	include ('../../inc/notif-act.php');
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$type= $_POST['jenis-s'];
	$cons = $_POST['konstruksi'];
	$lbang = $_POST['lbang'];
	$land = $_POST['lahan'];
	$parkir = $_POST['parkir'];
	$elect = $_POST['listrik'];
	$alamat = $_POST['alamat'];
	$year = $_POST['tahun'];
	$geom = $_POST['geom'];
	$murid = $_POST['murid'];
	$guru = $_POST['guru'];
	$kepala = $_POST['kepala'];
	$level = $_POST['level'];
			
	$sql = pg_query("INSERT INTO educational_building (educational_building_id, name_of_educational_building, headmaster_name, total_students, total_teachers, school_type, id_level_of_education, standing_year, building_area, land_area, parking_area, electricity_capacity, type_of_construction, address, geom) 
		VALUES ('$id', '$nama', '$kepala', '$murid', '$guru', '$type', '$level', '$year', '$lbang', '$land', '$parkir', '$elect', '$cons', '$alamat', ST_GeomFromText('$geom'))");


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