<?php 
//Connect database
$url = parse_url("mysql://b68fa225cf6581:6fa98ae2@eu-cdbr-west-02.cleardb.net/heroku_6eac11ed5355ee9?reconnect=true");
$servername = "eu-cdbr-west-02.cleardb.net";
$username = "b68fa225cf6581";
$password = "6fa98ae2";
$database = "heroku_6eac11ed5355ee9";

$conn = new mysqli($servername,$username,$password,$database);
if($conn->connect_error){
	die("Connection failed man: ". $conn->connect_error);
}

 ?>