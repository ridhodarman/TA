<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['kk4'] != null) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$kk = $_POST['kk4'];
		$nik = $_POST['nik4'];

		$sql = pg_query("UPDATE citizen SET 
						family_card_number = '$kk'
						WHERE national_identity_number = '$nik'");

		if ($sql){
			echo '<script>
				$("#updated").modal("show");
				</script>
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				';
		}
		echo '<meta http-equiv="REFRESH" content="1;url=../info-kk.php?id='.$kk.'">';
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>