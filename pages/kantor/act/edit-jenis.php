<?php
session_start();
if(isset($_SESSION['username'])) {
	include ('../../../inc/koneksi.php');
	$id = $_GET['id'];
	$jenis = $_GET['jenis-edit'];
	$sql = pg_query("UPDATE type_of_office SET name_of_type = '$jenis' WHERE type_id = '$id'");
}
?>