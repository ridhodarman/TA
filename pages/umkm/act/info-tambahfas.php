<?php
	session_start();
    if(isset($_SESSION['username']) && $_POST['id'] != null ) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id = $_POST['id'];
		$fas = $_POST['fasilitas'];
		$total = $_POST['total-fas']; 

		$cek = pg_num_rows( pg_query("SELECT facility_id FROM detail_msme_building_facilities WHERE msme_building_id='$id' AND facility_id='$fas'") );
		
		if ($cek>0) {
			echo '<script>
					$("#sudah").modal("show");
					</script>
					';
		}
		else {
			$sql = pg_query("INSERT INTO detail_msme_building_facilities (msme_building_id, facility_id, quantity_of_facilities) VALUES ('$id', '$fas', '$total')");
			if ($sql){
				echo '<script>
					$("#sukses").modal("show");
					</script>
					';
			}
			else {
				echo '<script>
					$("#gagal").modal("show");
					</script>
					';
			}
		}
		echo '<meta http-equiv="REFRESH" content="1;url=../info-umkm.php?id='.$id.'">';
	}

	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>