<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id = base64_decode( $_GET['id-foto'] );
		$bang = $_GET['id-bang'];
		$sql = pg_query("DELETE FROM msme_building_gallery WHERE photo_url = '$id'");
		if ($sql){
			$tempat_foto = '../../../foto/umkm/'.$id;
    		unlink($tempat_foto);
			echo '<script>
				$("#hapus").modal("show");
				</script>
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				';
		}
		echo '<meta http-equiv="REFRESH" content="1;url=../info-umkm.php?id='.$bang.'">';
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>