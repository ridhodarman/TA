<?php

	$host = "localhost";
	$user = "postgres";
	$pass = "root";
	$port = "5432";
	$dbname = "test_a";

	// $host = "otto.db.elephantsql.com";
	// $user = "mlfkcwyr";
	// $pass = "G3HHlRihRkOb8_4zn6HHJaLXKRbkaafD";
	// $port = "5432";
	// $dbname = "mlfkcwyr";

	$conn = pg_connect("host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$pass) or die("Gagal");

?>