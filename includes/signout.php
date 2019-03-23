<?php 
//Destroy session and go back to login page if logout button pressed
if(isset($_POST['logout'])){
	session_start();
	//unset and delete the cookies
	unset($_COOKIE['active_project']);
	setcookie('active_project',null,-1,'/');

	//Destory the session
	session_unset();
	session_destroy();
	header("Location: ../index.php");
}
 ?>
