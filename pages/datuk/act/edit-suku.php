<?php
session_start();
if(isset($_SESSION['username'])) {
	include ('../../../inc/koneksi.php');
	$id = $_GET['id'];
	$suku = $_GET['suku-edit'];
	$sql = pg_query("UPDATE tribe SET name_of_tribe = '$suku' WHERE tribe_id = '$id'");
}
?>