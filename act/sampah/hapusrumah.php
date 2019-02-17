<?php
include ('../inc/koneksi.php');
$id = $_GET['id'];
		
$sql = pg_query("DELETE FROM house WHERE id='$id'");


if ($sql){
	echo '<script>
		alert (" Data Successfully Deleted");
		</script>
		<meta http-equiv="REFRESH" content="0;url=../rumah.php">
		';
}
else {
	echo '<script>
		alert (" Error !");
		</script>
		<meta http-equiv="REFRESH" content="0;url=../rumah.php">
		';
}
	



?>