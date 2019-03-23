<?php
	include_once('dbconn.php'); //Db connection

	//Registration - If register button is pressed
	if(isset($_POST['register'])){
		$usr = $_POST['username']; //Username field
		$pwd = $_POST['pwd']; //Password field

		//Check if user exists
		include_once('userexists.php');

		//Error if fields are empty
		if(!isset($usr) || !isset($pwd) || trim($usr)=='' || trim($pwd)==''){
			header("Location: ../index.php?error=fieldsempty");
			exit();
		}
		//Error if user exists
		else if($user_exists==True){
			header("Location: ../index.php?error=usertaken");
			exit();
			
		}
		//If no errors, prepare statements to register player into db
		else if(isset($usr) && isset($pwd) && $user_exists==False){
			$sql = "INSERT INTO User(username,password) VALUES(?,MD5(?));"; //insert their data into the db
			$stmt = mysqli_stmt_init($conn); //init the register statement

			//If sql fails to run
			if(!mysqli_stmt_prepare($stmt,$sql)){
				header("Location: ../index.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"ss",$usr,$pwd); //Bind username and password into stmt fields
				mysqli_stmt_execute($stmt); //Execute the register prepared statement
				
				header("Location: ../index.php?success=registered");
				exit();
			}
		}
		//Close the connection
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}


	//Login - if login button is pressed
	else if(isset($_POST['login'])){
		$usr = $_POST['username'];
		$pwd = $_POST['pwd'];

		//Check if user exists
		include_once('userexists.php');

		//Error if fields are empty
		if(!isset($usr) || !isset($pwd) || trim($usr)=='' || trim($pwd)==''){
			header("Location: ../index.php?error=fieldsempty");
			exit();
		}
		//Error if user doesn't exist
		else if($user_exists==False){
			header("Location: ../index.php?error=nomatch");
			exit();
		}
		//If no errors, prepare statements to login player
		else if(isset($usr) && isset($pwd) && $user_exists==True){
				//Query for hashed password
				$sql = "SELECT * FROM User WHERE username=?;";
				$stmt = mysqli_stmt_init($conn);
				//If SQL fails to run
				if(!mysqli_stmt_prepare($stmt,$sql)){
					header("Location: ../index.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt,"s",$usr);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if($row = mysqli_fetch_assoc($result)){
						//Check if password entered and username associated password match
						$matched_pwd = $row['password'];
						if(!(md5($pwd)==$matched_pwd)){
							header("Location: ../index.php?error=nomatch");
							exit();
						}
						//If the passwords match, start the session
						else{
							session_start();
							$_SESSION['userid'] = $row['id'];
							$_SESSION['username'] = $row['username'];
							header("Location: ../index.php?success=loginsuccesful&uid=".$row['id']);
							exit();
						}
						exit();
					}
				}
			}
			//Close the connection
			mysqli_stmt_close($stmt);
			mysqli_close($conn);
		}

 ?>