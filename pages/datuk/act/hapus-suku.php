<?php
session_start();
if(isset($_SESSION['username'])) {
	include ('../../../inc/koneksi.php');
	$id = base64_decode( $_GET['id'] );
	$sql = pg_query("DELETE FROM tribe WHERE tribe_id = '$id'");
}
?>