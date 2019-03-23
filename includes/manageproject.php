<?php
	//Start the session for logged in user
	session_start();
	//Include db connection
	include_once('dbconn.php');

	//If the create project button is pressed
	if(isset($_GET['createproject'])){
		//globals
		$project_title = $_GET['title'];
		$userid = $_SESSION['userid'];
		
		//Check if nothing was entered in the title input field
		if((!isset($project_title) || trim($project_title)=="") && $numProjects<=5){
			header("Location: ../projects.php?error=emptyfields");
			exit();
		}
		else{
			$sql = "INSERT INTO Projects(userid,title) VALUES(?,?);"; //values: the user id, the title of the project
			$stmt = mysqli_stmt_init($conn);
			//If sql fails to run
			if(!mysqli_stmt_prepare($stmt,$sql)){
				header("Location: ../projects.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"is",$userid,$project_title);
				mysqli_stmt_execute($stmt);
				header("Location: ../projects.php?success=projectcreated&title=".$project_title."&userid=".$userid);
				exit();
			}
		}
	}
	//If the delete project button is pressed
	if(isset($_GET['deleteproject'])){
		if(!isset($_COOKIE['active_project'])){
			header("Location: ../projects.php?error=noactiveproject");
			exit();
		}
		else{
			//Delete active project and all tasks belonging to it if they exist
			$active_project = $_COOKIE['active_project'];
			$sql = "DELETE FROM Tasks WHERE projectid=$active_project";
			mysqli_query($conn,$sql);
			
			$sql = "DELETE FROM Projects WHERE projectid=$active_project;";
			mysqli_query($conn,$sql);

			//Unset the cookie for the active project
			unset($_COOKIE['active_project']);
			setcookie('active_project',null,-1,'/');
			
			header("Location: ../projects.php?success=deletedproject");
			exit();
		}
		
	}
 ?>