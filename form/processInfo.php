<?php

include_once("connectionDB.php");

//filter the inputs taken from the form
$typeService = filter_input(INPUT_POST, 'typeService', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);

//build the query string and pass it in the variable result_service
$result_service = "INSERT INTO services (service_type, service_price) VALUES ('$typeService', '$price')";

//check if the insertion goes well
mysqli_query($con, $result_service);

if (mysqli_insert_id($con)) {
	header("Location: thankyou/index.html");
} else {
	header("Location: thankyou/failure.html");
}
	
?>