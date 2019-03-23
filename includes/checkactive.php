<?php 
//Go to dashboard and display the project selected
include_once('dbconn.php');
if(isset($_GET['activate'])){
	$active_project = $_GET['activate'];
	$project_cookie_name = "active_project";
	setcookie($project_cookie_name,$active_project,0,"/");
	//Get the project id so it can be 'active'
	header("Location: ../projects.php?activeproject=".$active_project);
	exit();
}
?>
<?php
//If the mark as done button is pressed, update done status in sql
if(isset($_GET['markdone'])){
	$taskid = $_GET['markdone'];
	$sql = "UPDATE Tasks SET done=true WHERE taskid=$taskid;";
	$result = mysqli_query($conn,$sql);
	header("Location: ../main.php?task=$taskid");
	exit();
}
 ?>

<?php 
//If save button is pressed when notes are opened
if(isset($_GET['savebutton'])){
	$thenote = $_GET['thenote'];
	$save = $_GET['savebutton'];
	$sql = "UPDATE Tasks SET notes='$thenote' WHERE taskid=$save;";
	mysqli_query($conn,$sql);
	header("Location: ../main.php?note=saved");
	exit();
}


 ?>

<?php 
//If delete task button is pressed
if(isset($_GET['deletetask'])){
	$taskid = $_GET['deletetask'];
	$sql = "DELETE FROM tasks WHERE taskid=$taskid";
	mysqli_query($conn,$sql);
	header("Location: ../main.php?success=taskdeleted");
	exit();
}

 ?>