<?php
session_start();
if(isset($_SESSION['username'])) {
	include ('../../../inc/koneksi.php');
	$id = $_GET['id'];
	$nama = $_GET['nama'];
	$suku = $_GET['suku'];
	$sql = pg_query("UPDATE datuk SET 
					datuk_name = '$nama',
					tribe_id = '$suku'
					WHERE datuk_id = '$id'");
}
?>