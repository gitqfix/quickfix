<?php 

$hostname = "localhost";
$user = "root";
$password =  "";
$database = "quickfix";
$con = mysqli_connect($hostname, $user, $password, $database);

if(!$con){
	print "Deu ruim corno";
}

 ?>
