<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['id-temp'] != null) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id = $_POST['id'];
		$id_temp = $_POST['id-temp'];
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
				
		$sql = pg_query("UPDATE msme_building SET
						msme_building_id = '$id', 
						name_of_msme_building = '$nama', 
						type_of_msme = '$type', 
						building_area = '$lbang', 
						land_area = '$land', 
						parking_area = '$parkir', 
						standing_year = '$year', 
						electricity_capacity = '$elect', 
						type_of_construction = '$cons', 
						address = '$alamat', 
						owner_name = '$alamat', 
						number_of_employee = '$pegawai', 
						monthly_income = '$penghasilan', 
						contact_person = '$cp'
						WHERE msme_building_id = '$id_temp'");
		if ($sql){
			echo '<script>
				$("#updated").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-umkm.php?id='.$id.'">
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-umkm.php?id='.$id_temp.'">
				';
		}
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>