<?php 

	//Check if username and pwd fields are filled
	if(!isset($usr) || !isset($pwd) || trim($usr)=='' || trim($pwd)==''){
		header("Location: ../index.php?error=fieldsempty");
		exit();
	} 
	//Check if username already exists
	else if($user_exists==True){
		header("Location: ../index.php?error=usertaken");
		exit();
		
	}

 ?>