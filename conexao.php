<?php
$server = "localhost";
$user = "root";
$pass = "";
$dbname = "quickfix";

$conx = mysqli_connect($server,$user,$pass,$dbname);
mysqli_set_charset( $conx, 'utf8');
if (!$conx) {
 	die("Falha:" . mysqli_connect_error());
	
}

?>