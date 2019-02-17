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
	$pemilik = $_POST['pemilik'];
	$penghasilan = str_replace(".", "", $_POST['penghasilan']);
	$cp = $_POST['kontak'];
	$pegawai = $_POST['pegawai'];
			
	$sql = pg_query("INSERT INTO msme_building (msme_building_id, name_of_msme_building, type_of_msme, building_area, land_area, parking_area, standing_year, electricity_capacity, type_of_construction, address, owner_name, number_of_employee, monthly_income, contact_person, geom) 
		VALUES ('$id', '$nama', '$type', '$lbang', '$land', '$parkir', '$year', '$elect', '$cons', '$alamat', '$pemilik', '$pegawai', '$penghasilan', '$cp', ST_GeomFromText('$geom'))");


	if ($sql){
		echo '<script>
			$("#sukses").modal("show");
			</script>
			<meta http-equiv="REFRESH" content="1;url=../info-umkm.php?id='.$id.'">
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