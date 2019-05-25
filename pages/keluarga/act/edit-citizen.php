<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$kk = "'".$_POST['kk']."'"; if ($_POST['kk']!="0") { if (empty($_POST['kk'])){$kk =	"null";}	}
		$nik = $_POST['nik'];
		$nik_temp = $_POST['nik-temp'];
		$nama = $_POST['nama'];
		$tgl = $_POST['tgl'];
		$pend = $_POST['pend'];
		$job = $_POST['kerja'];
		$income = str_replace(".", "", $_POST['penghasilan']);
		$datuk = $_POST['datuk'];
		$status = "'".$_POST['status']."'"; if ($_POST['status']!="0") { if (empty($_POST['status'])){$status =	"null";}	}

		$sql = pg_query("UPDATE citizen SET
						national_identity_number = '$nik',
						family_card_number = ".$kk.",
			 			name = '$nama',
			 			birth_date = '$tgl',
			 			education_id = '$pend',
			 			job_id = '$job',
			 			datuk_id = '$datuk',
			 			income = '$income',
			 			status_in_family = ".$status."
						WHERE national_identity_number = '$nik_temp'");
		if ($sql){
			echo '<script>
				$("#updated").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-citizen.php?id='.$nik.'">
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-citizen.php?id='.$nik_temp.'">
				';
		}
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>