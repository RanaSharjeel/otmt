<?php 
include_once("dbconn.php");
//Check if fields are empty
if(isset($_GET['done'])){
	//Get all the input field vars
	$taskname = $_GET['taskname'];
	$taskdue = $_GET['taskdue'];
	$taskpriority = $_GET['taskpriority'];
	$active_project = $_COOKIE['active_project'];

	//Check if fields are missing values
	if(!isset($taskname) || !isset($taskdue) || trim($taskname)=="" || trim($taskdue)==""){
		header("Location: ../main.php?error=emptyfields");
		exit();
	}
	//If no values are missing - enter information into task table
	else{
		$sql = "INSERT INTO Tasks(projectid,taskname,taskdue,priority,notes,done) VALUES(?,?,?,?,'',false);";
		$stmt = mysqli_stmt_init($conn);
		//if sql fails to run
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../main.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"dsss",$active_project,$taskname,$taskdue,$taskpriority);
			mysqli_stmt_execute($stmt);
			header("Location: ../main.php?success=taskcreated");
			exit();
		}
	}
}

 ?>