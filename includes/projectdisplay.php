<?php 
include_once('dbconn.php');
//If project isn't active (no cookies set), display no active project text
if(!isset($_COOKIE['active_project'])){
	echo "<br>";
	echo "<h2>No Active Project</h2>";
} else{
	//Include HTML in else statement (when a project is active)
	?>
	<div class="interface">
		<div id="dashboardinterface" class="projects">
			<h2 id='dashboardprojectname'>
				<?php 
				//Get active project name
				$active_project = $_COOKIE['active_project'];
				$sql = "SELECT title FROM Projects WHERE projectid=$active_project";
				$result = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_assoc($result)){
					echo($row['title']);
				}
				
				 ?>
			</h2>
			<!--Create a task button-->
			<form id='createform' action='includes/tasklayout.php' method='GET'>
			<button id="createtaskbutton" type="submit" class="generic" name="createtask">Create Task</button>
			</form>
			<br>
			<table id="tasktable">
				<tr class="regulartext">
					<th>Name</th>
					<th>Due</th>
					<th>Priority</th>
					<th>Notes</th>
					<th>Done</th>
					<th>Delete</th>
				</tr>
				<?php
				//Query to get fields from tasks table
				$sql = "SELECT * FROM Tasks WHERE projectid=$active_project ORDER BY priority;";
				$result = mysqli_query($conn,$sql);
				//Get the array of the row values and display the information in a table row
				for($i=1; $i<=mysqli_num_rows($result); $i++){
					$row = mysqli_fetch_assoc($result);
					$taskid = $row['taskid'];
					echo "<tr>";
					if($row['taskdue']<date("Y-m-d")){
						echo "<td>"."<span style='color:red;'>".$row['taskname']."</span>"."</td>";
						echo "<td>"."<span style='color:red;'>".$row['taskdue']." LATE"."</span>"."</td>";
					}
					else if($row['done']==0){
						echo "<td>".$row['taskname']."</td>";
						echo "<td>".$row['taskdue']."</td>";	
					}
					else if($row['done']==1){
					echo "<td>"."<span style='color:green;'>".$row['taskname']."</span>"."</td>";
					echo "<td>"."<span style='color:green;'>".$row['taskdue']." DONE"."</span>"."</td>";
					}
					

					//Display different icons depending on the priority
					switch ($row['priority']) {
						case "High":
							echo "<td>"."<img src='images/high.png' style='width:15px;height:15px;'></img>"."</td>";
							break;
						case "Medium":
							echo "<td>"."<img src='images/medium.png' style='width:15px;height:15px;'></img>"."</td>";
							break;
						case "Low":
							echo "<td>"."<img src='images/low.png' style='width:15px;height:15px;'></img>"."</td>";
							break;
					}
					//Notes expand button
					echo "<td><form action='' post='GET'>".
					"<button class='activebutton' type='submit' name='checknotes' value=$taskid>N</button>"
					."</form></td>";
					//Mark as done button
					echo "<td><form action='includes/checkactive.php' post='GET'>".
					"<button id=$taskid class='activebutton' type='submit' name='markdone' value=$taskid>D</button>"
					."</form></td>";
					//Delete button
					echo "<td><form action='includes/checkactive.php' post='GET'>".
					"<button class='activebutton' type='submit' name='deletetask' value=$taskid>x</button>"
					."</form></td>";
					echo "</tr>";
				}

				 ?>
			</table>
		</div>
	</div>
<?php 
} //Close else statement 
?>

<?php 
//Check if notes is checked
if(isset($_GET['checknotes'])){
	$checknotes = $_GET['checknotes'];
	?>
	<div id="overlay">
		<div id="notesformdiv">
			<form id="notesform" action="includes/checkactive.php" method="GET">
				<textarea name="thenote"><?php 
				//Display the note already saved in textarea
				$sql = "SELECT notes FROM tasks WHERE taskid=$checknotes;";
				$result = mysqli_query($conn,$sql);
				while($row=mysqli_fetch_assoc($result)){
					echo($row['notes']);
				}

				 ?></textarea>
				<br>
				<button id="savebutton" class="generic" name="savebutton" value=<?php echo($checknotes)?>>Save</button>
			</form>
		</div>
	</div>
<?php
}

 ?>

<?php 
//Check if task message is set
if(isset($_GET['task'])){
	$task = $_GET['task'];
	if($task=="create"){
	?>
	<div id="overlay">
		<div id="taskformdiv">
			<p id="texttaskname">Task Name:</p>
			<p id="texttaskdue">Task Due:</p>
			<p id="texttaskpriority">Priority:</p>
			<form id="createtaskform" action="includes/managetask.php" method="GET">
				<input id="inputtaskname" class="inputfield" type="text" name="taskname" placeholder="Task Name">
				<br>
				<input id="inputtaskdue" class="inputfield" type="date" name="taskdue">
				<br>
				<select id="inputtaskpriority" class="inputfield" name="taskpriority">
					<option value="high">High</option>
					<option value="medium">Medium</option>
					<option value="low">Low</option>
				</select>
				<br>
				<button id="donebutton" type="submit" class="generic" name="done">Done</button>
			</form>
		</div>
	</div>

<?php
	} //End task create check
}
?>
