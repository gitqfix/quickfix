<?php

//establish the connection
try {
	$con = mysqli_connect("localhost", "root", "1234", "quickfix");
} catch (Exception $e) {
	echo "The connection failed";
}

?>