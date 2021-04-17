<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
	$conflicting_time_error = "";

	

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$university_name = $user_data['university_name'];
		$rso_name = $user_data['rso_name'];
		$event_type = $_POST['event_type'];
		$event_name = $_POST['event_name'];
		$location_name = $_POST['location_name'];
		$event_description = $_POST['event_description'];
		$date = date('Y-m-d', strtotime($_POST['date']));
		$start_time = date('H:i:s', strtotime($_POST['start_time']));
		$end_time = date('H:i:s', strtotime($_POST['end_time']));

		if(!empty($university_name) && !empty($rso_name) && !empty($event_type) && !empty($event_name) && !empty($event_description) && !empty($date) && !empty($start_time) && !empty($end_time) && !empty($location_name))
		{
			$event_data = load_events($con);
			$already_exists = false;
			while($event = mysqli_fetch_array($event_data))
			{
				if(($event['date'] == $date) && ($event['location_name'] == $location_name))
				{
					$inputComparisonS = strtotime($start_time);
					$inputComparisonE = strtotime($end_time);
					$databaseComparisonS = strtotime($event['start_time']);
					$databaseComparisonE = strtotime($event['end_time']);

					if((($inputComparisonE - $databaseComparisonS) > 0) && (($databaseComparisonE - $inputComparisonS) > 0))
					{
						$already_exists = true;
					}
				}
			}

			if($already_exists == false)
			{
				//save to database
				$query = "insert into events (university_name,rso_name,event_type,event_name,location_name,event_description,date,start_time,end_time) values ('$university_name','$rso_name','$event_type','$event_name','$location_name','$event_description', '$date', '$start_time', '$end_time')";

				mysqli_query($con, $query);

				header("Location: admin-index.php");
				die;
			}else
			{
				$conflicting_time_error = "Could not add event! There is a conflicting time with an already existing event!";
			}

			
			
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>College Events</title>
</head>

<body>

	<style type="text/css">
		
		#text{

			height: 25px;
			border-radius: 5px;
			padding: 4px;
			border: solid thin #aaa;
			width: 100%;
		}

		#button{

			padding: 10px;
			width: 100px;
			color: white;
			background-color: lightblue;
			border: none;
		}

		#box{
			
			background-color: grey;
			margin: left;
			width: 300px;
			padding: 20px;
		}

		#events{
			
			background-color: grey;
			margin: auto;
			width: 500px;
			padding: 20px;
		}

		h4
		{
			color: white;
		}
		table
		{
			border-collapse: separate;
  			border-spacing: 2px;
		}
	</style>


	<div style="text-align:right"> 
	<p>RSO Admin View</p>
	<p>Logged in as, <?php echo $user_data['rso_name']; ?></p>
   
	<a href="logout.php">Logout</a>
	</div>
	<h1 style="text-align:center">College Events</h1>
	<br>
	<h2>Create an Event:</h2>
	<br>
	<div id="box">
		<form method="post">
			<h4>Event Type</h4>
			<input id="text" type="text" name="event_type"><br>
			<h4>Event Name</h4>
			<input id="text" type="text" name="event_name"><br>
			<h4>Location Name</h4>
			<input id="text" type="text" name="location_name"><br>
			<h4>Description</h4>
			<input id="text" type="text" name="event_description"><br>
			<h4>Date</h4>
			<input id="text" type="date" name="date"><br><br>
			<h4>Start Time</h4>
			<input id="text" type="time" name="start_time"><br><br>
			<h4>End Time</h4>
			<input id="text" type="time" name="end_time"><br><br>
			<input id="button" type="submit" value="Create Event"><br><br>
			<p><?php echo $conflicting_time_error ?></p>
		</form>
	</div>
	<br><br>

	<h2 style="text-align:center">Upcoming Events:</h2><br>
	<h3 style="text-align:center">Public Events:</h3>
	<p><?php 
	$event_data = load_events($con);
	while($event = mysqli_fetch_array($event_data))
	{
		if($event['event_type'] == 'Public')
		{
			echo '<div id="events">';
			echo "<h4> {$event['event_name']} </h4>";
			echo "<p> University: {$event['university_name']} </p>";
			echo "<p> RSO: {$event['rso_name']} </p>";
			echo "<p> Event Type: {$event['event_type']} </p>";
			echo "<p> Description: {$event['event_description']} </p>";
			echo "<p> Date: {$event['date']} </p>";
			echo "<p> Start Time: {$event['start_time']} </p>";
			echo "<p> End Time: {$event['end_time']} </p>";
			$currentEvent = $event['event_name'];
			$query = "select * from comments where event_name = '$currentEvent'";
			$all_comments = mysqli_query($con,$query);
			$count = 0;
			while($currentComment = mysqli_fetch_array($all_comments))
			{
				$count = $count + 1;
			}
			$all_comments = mysqli_query($con,$query);
			if($count > 0)
			{
				echo "<h4>Comments:</h4>";
				while($currentComment = mysqli_fetch_array($all_comments))
				{
					echo "<p> User: {$currentComment['student_username']} </p>";
					echo "<p> Comment: {$currentComment['comment']} </p><br>";
				}
			}
			echo "</div>";
			echo "<br>";
		}
	}
	?></p>
	<h3 style="text-align:center">Private University Events:</h3>
	<p><?php
	$event_data = load_events($con);
	while($event = mysqli_fetch_array($event_data))
	{
		if($event['event_type'] == 'Private_Uni')
		{
			echo '<div id="events">';
			echo "<h4> {$event['event_name']} </h4>";
			echo "<p> University: {$event['university_name']} </p>";
			echo "<p> RSO: {$event['rso_name']} </p>";
			echo "<p> Event Type: {$event['event_type']} </p>";
			echo "<p> Description: {$event['event_description']} </p>";
			echo "<p> Date: {$event['date']} </p>";
			echo "<p> Start Time: {$event['start_time']} </p>";
			echo "<p> End Time: {$event['end_time']} </p>";
			$currentEvent = $event['event_name'];
			$query = "select * from comments where event_name = '$currentEvent'";
			$all_comments = mysqli_query($con,$query);
			$count = 0;
			while($currentComment = mysqli_fetch_array($all_comments))
			{
				$count = $count + 1;
			}
			$all_comments = mysqli_query($con,$query);
			if($count > 0)
			{
				echo "<h4>Comments:</h4>";
				while($currentComment = mysqli_fetch_array($all_comments))
				{
					echo "<p> User: {$currentComment['student_username']} </p>";
					echo "<p> Comment: {$currentComment['comment']} </p><br>";
				}
			}
			echo "</div>";
			echo "<br>";
		}
	}
	?></p>
	<h3 style="text-align:center">Private RSO Events:</h3>
	<p><?php
	$event_data = load_events($con);
	while($event = mysqli_fetch_array($event_data))
	{
		if($event['event_type'] == 'Private_RSO')
		{
			if($event['rso_name'] == $user_data['rso_name'])
			{
				echo '<div id="events">';
				echo "<h4> {$event['event_name']} </h4>";
				echo "<p> University: {$event['university_name']} </p>";
				echo "<p> RSO: {$event['rso_name']} </p>";
				echo "<p> Event Type: {$event['event_type']} </p>";
				echo "<p> Description: {$event['event_description']} </p>";
				echo "<p> Date: {$event['date']} </p>";
				echo "<p> Start Time: {$event['start_time']} </p>";
				echo "<p> End Time: {$event['end_time']} </p>";
				$currentEvent = $event['event_name'];
				$query = "select * from comments where event_name = '$currentEvent'";
				$all_comments = mysqli_query($con,$query);
				$count = 0;
				while($currentComment = mysqli_fetch_array($all_comments))
				{
					$count = $count + 1;
				}
				$all_comments = mysqli_query($con,$query);
				if($count > 0)
				{
					echo "<h4>Comments:</h4>";
					while($currentComment = mysqli_fetch_array($all_comments))
					{
						echo "<p> User: {$currentComment['student_username']} </p>";
						echo "<p> Comment: {$currentComment['comment']} </p><br>";
					}
				}
				echo "</div>";
				echo "<br>";
			}
			
		}
	}
	?></p>

</body>
</html>