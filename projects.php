<?php 
session_start();
include_once('includes/dbconn.php');
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

<div class="interface">
	<div class="projects">
		<form action="includes/manageproject.php" method="GET">
		<button id="createprojectbutton" class="generic" type="submit" name="createproject">Create Project</button>
		<button id="deleteprojectbutton" class="generic" type="submit" name="deleteproject">Delete Project</button>
		<input id="titleinput" class="inputfield" type="text" name="title" placeholder="Project Title">
		</form>
		<br>
		
		<table>
			<tr class="regulartext">
				<th>Activate</th>
				<th>Title</th>
				<th>Creator</th>
			</tr>
			<?php 
			$userid = $_SESSION['userid'];
			$sql = "SELECT * FROM User,Projects WHERE Projects.userid=$userid AND User.id=$userid;";
			$result = mysqli_query($conn,$sql);
			for($i=1; $i<=mysqli_num_rows($result); $i++){
				$row = mysqli_fetch_assoc($result);
				$projectid = $row['projectid'];
				//Enter row into database
				echo "<tr>";
				//A button which when clicked will marked respective project as active
				echo "<td><form action='includes/checkactive.php' post='GET'>".
				"<button id=$projectid class='activebutton' type='submit' name='activate' value=$projectid>x</button>"
				."</form></td>";
				echo "<td>". $row['title']."</td>";
				echo "<td>". $row['username']."</td>";

			}
			
			mysqli_close($conn);

			 ?>
			
		</table>
	</div>
</div>

<?php
//If the active project cookie is set, print it to the page in a hidden p tag to be used in js
if(isset($_COOKIE['active_project'])){
	$active_project_cookie = $_COOKIE['active_project'];
	echo "<p id='displayactive' hidden>$active_project_cookie<p>";
}
?>

<script>
	var activeproject = document.getElementById('displayactive').innerHTML;
	document.getElementById(activeproject).style.backgroundColor = '#491bb2';

</script>

</body>
</html>