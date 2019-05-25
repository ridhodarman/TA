<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['kk'] != null ) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$kk_temp = $_POST['kk'];
		$kk = $_POST['kk2'];
		$kategori = "'".$_POST['kategori']."'"; if ($_POST['kategori']!="0") { if (empty($_POST['kategori'])){$kategori =	"null";}	}
		$rumah = "'".$_POST['rumah']."'"; if (empty($_POST['rumah'])) {$rumah =	"null";}

		$sql = pg_query("UPDATE family_card SET
						family_card_number = '$kk',
			 			category = ".$kategori.",
			 			house_building_id = ".$rumah."
						WHERE family_card_number = '$kk_temp'");
		if ($sql){
			echo '<script>
				$("#updated").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-kk.php?id='.$kk.'">
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-kk.php?id='.$kk_temp.'">
				';
		}
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>