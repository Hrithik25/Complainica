<?php
$dbServerName="localhost";
$dbUserName="root";
$dbPassword="";
$dbName="maintenancePortalDB";

$conn=mysqli_connect($dbServerName,$dbUserName,$dbPassword,$dbName);
if(!$conn){
	die('connection failed'.mysqli_connect_error());
}

?>