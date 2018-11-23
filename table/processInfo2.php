<?php

require_once("connectionDB.php");

$result_service_list = mysqli_query($con, "SELECT * FROM services");

while ($item = mysqli_fetch($result_service_list)) {
	echo "<tr>";
	echo "<td>".$item['service_type']."</td>";
	echo "<td>".$item['service_price']."</td>";
	echo "<tr>";
}

?>