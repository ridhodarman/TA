<?php
session_start();
if(isset($_SESSION['username'])) {
	include ('../../../inc/koneksi.php');
	$id = base64_decode( $_GET['id'] );
	$sql = pg_query("DELETE FROM health_building_facilities WHERE facility_id = '$id'");
}
?>