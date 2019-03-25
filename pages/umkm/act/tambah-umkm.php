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
	$pemilik = $_POST['pemilik'];
	$penghasilan = str_replace(".", "", $_POST['penghasilan']); if (empty($_POST['penghasilan'])) {$penghasilan = "0"; }
	$cp = $_POST['kontak'];
	$pegawai = $_POST['pegawai']; if (empty($_POST['pegawai'])) {$pegawai = "0"; }
			
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