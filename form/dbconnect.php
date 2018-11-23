<?php

$db_host = "localhost";
$db_name = "quickfix";
$db_user = "root";
$db_pass = "1234";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Checa conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
