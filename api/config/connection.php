<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
// ////////////for local connect 
//$_HOST_NAME = "192.168.11.173";  
$_HOST_NAME = "localhost";  
$_DB_USERNAME="root";
$_DB_PASSWORD="";



///// for live connect
// $_HOST_NAME = 'localhost';  
// $_DB_USERNAME ='freefocu_alwaysonlineclasses';
// $_DB_PASSWORD ='ab@AfooTECH';

$conn = mysqli_connect($_HOST_NAME, $_DB_USERNAME, $_DB_PASSWORD)or die("Unable to connect to MySQL");
mysqli_select_db($conn,"freefocu_alwaysonlineclasses");
/////////////////////////////////////////////////////
?>
