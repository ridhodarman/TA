<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['nik'] != null ) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$nik = $_POST['nik'];
		$kk = "'".$_POST['kk']."'"; if ($_POST['kk']!="0") { if (empty($_POST['kk'])){$kk =	"null";}	}
		$nama = $_POST['nama'];
		$tgl = $_POST['tgl'];
		$pend = $_POST['pend'];
		$job = $_POST['kerja'];
		$income = str_replace(".", "", $_POST['penghasilan']);
		$datuk = $_POST['datuk'];
		$status = "'".$_POST['status']."'"; if ($_POST['status']!="0") { if (empty($_POST['status'])){$status =	"null";}	}

		if (empty($_POST['tgl2'])) {
			$tgl = "1900-01-01";
		}

		if (empty($_POST['penghasilan'])) {
			$income=0;
		}

		$sql = pg_query("INSERT INTO citizen (national_identity_number, family_card_number, name, birth_date, education_id, job_id, datuk_id, income, status_in_family) 
			VALUES ('$nik', ".$kk.", '$nama', '$tgl', '$pend', '$job', '$datuk', '$income', ".$status.")");

		if ($sql){
			echo '<script>
				$("#sukses").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-citizen.php?id='.$nik.'">
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