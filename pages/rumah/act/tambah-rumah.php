<?php
session_start();
if(isset($_SESSION['username']) && $_POST['id'] != null ) {
	include ('../../../inc/koneksi.php');
	include ('../../inc/notif-act.php');
	$id = $_POST['id'];
	$year = $_POST['tahun'];
	$pbb = $_POST['pbb'];
	$cons = $_POST['konstruksi'];
	$lbang = $_POST['lbang'];
	$land = $_POST['lahan'];
	$elect = $_POST['listrik'];
	$tap = $_POST['water'];
	$status = $_POST['status'];
	$address = $_POST['alamat'];
	$owner = "'".$_POST['pemilik']."'"; if (empty($_POST['pemilik'])) {$owner = "null"; }
	$geom = $_POST['geom'];
	$model = $_POST['model'];

	// if ($owner==null) {
	// 	$owner = "0";
	// }
	
	$query="INSERT INTO house_building 
		(house_building_id, address, standing_year, land_building_tax, type_of_construction, electricity_capacity, tap_water, building_status, owner_id, geom, model_id) 
		VALUES 
		('$id', '$address', '$year', '$pbb', '$cons', '$elect', '$tap', '$status', ".$owner.", ST_GeomFromText('$geom'), '$model')";

	$sql = pg_query($query);

	if ($sql){
		echo '<script>
			$("#sukses").modal("show");
			</script>
			<meta http-equiv="REFRESH" content="1;url=../info-rumah.php?id='.$id.'">
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