<?php
//session_start();
include_once("conx.php");

$email = $_POST['email'];
$catsup = $_POST['catsup'];
$descsup = $_POST['descsup'];


$insert_query = "INSERT INTO sup (id, email, catg, descsup) 
VALUES ('1', '$email', '$catsup', '$descsup')";

$insert = mysqli_query($con, $insert_query);

mysqli_close($con);

?>


