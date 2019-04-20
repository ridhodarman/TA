<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['kk2'] != null ) {
		include ('../../../inc/koneksi.php');

		$kk = $_POST['kk2'];
		$nama = $_POST['nama2'];
		$tgl = $_POST['tgl2'];
		$pend = $_POST['pend2'];
		$job = $_POST['kerja2'];
		$income = str_replace(".", "", $_POST['penghasilan2']);
		$asuransi = $_POST['asuransi2'];
		$tab = $_POST['tabungan2'];
		$kampung = $_POST['kampung2'];
		$tanggung = $_POST['tanggung2'];
		$datuk = $_POST['datuk2'];

		if (empty($_POST['tgl2'])) {
			$tgl = "1900-01-01";
		}

		if (empty($_POST['penghasilan2'])) {
			$income=0;
		}

		if (empty($_POST['tanggung2'])) {
			$tanggung=0;
		}

		$sql = pg_query("INSERT INTO family_card (family_card_number, head_of_family, birth_date, educational_id, job_id, village_id, datuk_id, insurance, savings, income, the_number_of_dependents) 
			VALUES ('$kk', '$nama', '$tgl', '$pend', '$job', '$kampung', '$datuk', '$asuransi', '$tab', '$income', '$tanggung')");
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>