<?php
include ('../inc/koneksi.php');
$id = $_POST['id'];
$nama = $_POST['nama'];
$geom = $_POST['geom'];
		
$sql = pg_query("insert into house (id, name, geom) values ('$id', '$nama', ST_GeomFromText('$geom'))");


if ($sql){
	echo '<script>
		alert (" Data Successfully Added");
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