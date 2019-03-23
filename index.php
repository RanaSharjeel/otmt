<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<title>Login</title>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/login_stylesheet.css">
</head>
<body>
	<header>
		<div class="container">
			<h1>SQ<span>18335</span></h1>
		</div>
	</header>

	<div class="otmt">
		<h1>Online Task Management Tool</h1>
	</div>
	<br>
	
	<div class="login_ui">
		<form action="/includes/signin.php" method="POST">
			<input type="text" name="username" placeholder="Username">
			<br>
			<input type="password" name="pwd" placeholder="Password">
			<br>
			<button class="submit-button" type="submit" name="login">Login</button>
			<br>
			<button class="submit-button" type="submit" name="register">Register</button>
			<br><br>
			<?php 
			//Display appropriate error message under the login form when input is invalid
			if(isset($_GET['error'])){
				$error_msg = $_GET['error'];
				//If the username is taken (register)
				if($error_msg == 'usertaken'){
					echo("<p class='signin_message'>Username is already taken</p>");
					exit();
				}
				//If user doesn't exist (login)
				else if($error_msg == 'nomatch'){
					echo("<p class = signin_message>Username or password don't match</p>");
				}
				//If fields were empty
				else if($error_msg = 'fieldsempty'){
					echo("<p class='signin_message'>Please fill in all fields</p>");
					exit();
				}
			} 
			//If you successfully registered, get success message
			if(isset($_GET['success'])){
				$success_msg = $_GET['success'];
				if($success_msg == 'registered'){
					echo("<p class='signin_message'>You have been registered</p>");
				}	
			}
			//If you successfully login, switch to main page
			if(isset($_SESSION['userid'])){
				header("Location: ../main.php");
			}
			 ?>
			
			
		</form>
	</div>
</body>
</html>