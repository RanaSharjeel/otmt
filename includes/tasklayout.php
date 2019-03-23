<?php 
//If the create a task button is clicked
if(!isset($_GET["createtask"])){
	header("Location: ../main.php?error=notset");
	exit();
} else{
	header("Location: ../main.php?task=create");
	exit();
}

?>
