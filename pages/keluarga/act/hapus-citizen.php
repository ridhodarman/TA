<?php
session_start();
if(isset($_SESSION['username'])) {
	include ('../../../inc/koneksi.php');
	$id = base64_decode( $_GET['id'] );
	$sql = pg_query("DELETE FROM citizen WHERE national_identity_number = '$id'");
}
?>