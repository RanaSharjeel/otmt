<?php 
session_start();
//echo $_SESSION['userid'];
 ?>

<!DOCTYPE html>
<html>
<title>Login</title>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/main_stylesheet.css">
</head>
<header>
	<div class="container">
		<h1>SQ<span>18335</span></h1>
		<nav>
			<ul>
				<li><a href="main.php">Tasks</a></li>
				<li><a href="projects.php">Projects</a></li>
				<li>
					<form action="includes/signout.php" method="POST">
						<button class="generic" type="submit" name="logout">Logout</button>
					</form>
				</li>
			</ul>
		</nav>
	</div>
</header>
<body>
<div class="welcome">
	<h1>Welcome, <?php 
	$username = $_SESSION['username'];
	echo("<span>$username</span>");
	 ?>
	</h1>
	
</div>
<br>	
<?php 
//Display project on dashboard if active
include_once('includes/projectdisplay.php');


 ?>
</body>
</html>