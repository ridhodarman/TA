<?php
session_start();
if(isset($_SESSION['username'])) {
	include ('../../../inc/koneksi.php');
	$id = $_GET['id'];
	$fas = $_GET['fas'];
	$sql = pg_query("UPDATE health_building_facilities SET name_of_facility = '$fas' WHERE facility_id = '$id'");
}
?>