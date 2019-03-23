<?php 

//Check if username already exists
$sql = "SELECT * FROM User WHERE username=?;"; //Query if username already exists
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
	header("Location: ../index.php?error=sqlerror");
	exit();
}
else{
	mysqli_stmt_bind_param($stmt,"s",$usr);
	mysqli_stmt_execute($stmt);

	mysqli_stmt_store_result($stmt); //Store the results
					
	$num_users = mysqli_stmt_num_rows($stmt);
	//Determine if user exists by seeing if rows of usernames return
	if($num_users!=0){
		$user_exists = True;
		}else{
			$user_exists = False;
		}
}

 ?>