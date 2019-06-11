<?php
session_start();
if(isset($_SESSION['username'])) {
	include ('../../../inc/koneksi.php');
	$id = $_GET['id'];
	$tingkat = $_GET['tingkat-edit'];
	$sql = pg_query("UPDATE level_of_education SET name_of_level = '$tingkat' WHERE level_id = '$id'");
}
?>