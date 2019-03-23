<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['kk'] != null ) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$kk = $_POST['kk'];
		$kk2 = $_POST['kk-temp'];
		$nama = $_POST['nama'];
		$tgl = $_POST['tgl'];
		$pend = $_POST['pend'];
		$job = $_POST['kerja'];
		$income = str_replace(".", "", $_POST['penghasilan']);
		$asuransi = $_POST['asuransi'];
		$tab = $_POST['tabungan'];
		$kampung = $_POST['kampung'];
		$tanggung = $_POST['tanggung'];
		$datuk = $_POST['datuk'];

		$sql = pg_query("UPDATE householder SET
						family_card_number = '$kk',
			 			head_of_family = '$nama',
			 			birth_date = '$tgl',
			 			educational_id = '$pend',
			 			job_id = '$job',
			 			village_id = '$kampung',
			 			datuk_id = '$datuk',
			 			insurance = '$asuransi',
			 			savings = '$tab',
			 			income = '$income',
			 			the_number_of_dependents = '$tanggung'
						WHERE family_card_number = '$kk2'");
		if ($sql){
			echo '<script>
				$("#updated").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-holder.php?id='.$kk.'">
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-holder.php?id='.$kk2.'">
				';
		}
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>