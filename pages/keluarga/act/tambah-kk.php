<?php
session_start();
if(isset($_SESSION['username']) && $_POST['kk2'] != null ) {
	include ('../../../inc/koneksi.php');
	$kk = $_POST['kk2'];
	$kategori = "'".$_POST['kategori']."'"; if ($_POST['kategori']!="0") { if (empty($_POST['kategori'])){$kategori =	"null";}	}
	$rumah = "'".$_POST['rumah']."'"; if (empty($_POST['rumah'])) {$rumah =	"null";}
	$sql = pg_query("INSERT INTO family_card (family_card_number, house_building_id, category) 
		VALUES ('$kk', ".$rumah.", ".$kategori.")");
}
?>