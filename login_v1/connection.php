<?php 
session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";

$connection = new mysqli($server, $username, $password, $dbname);

if($connection->connect_error){
	die("Failed". mysqli_connect_error());
}


?>