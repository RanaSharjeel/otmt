<?php 
//Connect database
$servername = "localhost";
$username = "root";
$password = "none";
$database = "taskdb";

$conn = new mysqli($servername,$username,$password,$database);
if($conn->connect_error){
	die("Connection failed man: ". $conn->connect_error);
}

 ?>