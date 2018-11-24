<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
require_once '../dbconnect.php';

// sql to delete a record
$sql = "DELETE FROM services WHERE serviceId = $id"; 

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: ../index.php'); 
} else {
    echo "Error deleting record";
}
?>