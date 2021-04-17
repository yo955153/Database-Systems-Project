<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
	$event_data = load_events($con);

	if(isset($_POST['createEvent']))
	{
		$university_name = $_POST['university_name'];
		$rso_name = $_POST['rso_name'];
		$event_type = $_POST['event_type'];
		$event_name = $_POST['event_name'];
		$event_description = $_POST['event_description'];
		$start_date_time = date('Y-m-d H:i:s', strtotime($_POST['start_date_time']));

		if(!empty($university_name) && !empty($rso_name) && !empty($event_type) && !empty($event_name) && !empty($event_description))
		{

			//save to database
			$query = "insert into events (university_name,rso_name,event_type,event_name,event_description, start_date_time) values ('$university_name','$rso_name','$event_type','$event_name','$event_description', '$start_date_time')";

			mysqli_query($con, $query);

			header("Location: super-admin-index.php");
			die;
			
		}else
		{
			echo "Please enter some valid information!";
		}
	}else if(isset($_POST['createRSO']))
	{
		$rso_name = $_POST['rso_name'];
		$rso_password = $_POST['rso_password'];

		if(!empty($rso_password) && !empty($rso_name))
		{
			$query = "insert into admin (rso_name,rso_password) values ('$rso_name','$rso_password')";

			mysqli_query($con, $query);

			header("Location: super-admin-index.php");
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
	<p>Super Admin View</p>
	<p>Logged in as, <?php echo $user_data['university_name']; ?></p>
   
	<a href="logout.php">Logout</a>
	</div>
	<h1 style="text-align:center">College Events</h1>
	<br>
	<h2>Create an RSO:</h2>
	<br>
	<div id="box">
		<form method="post">
			<h4>RSO Name</h4>
			<input id="text" type="text" name="rso_name"><br>
			<h4>RSO Password</h4>
			<input id="text" type="password" name="rso_password"><br>
			<input id="button" type="submit" name="createRSO" value="Create RSO"><br><br>
		</form>
	</div>
	<br><br>
	<h2>Create an Event:</h2>
	<br>
	<div id="box">
		<form method="post">
			<h4>Event Type</h4>
			<input id="text" type="text" name="event_type"><br>
			<h4>Event Name</h4>
			<input id="text" type="text" name="event_name"><br>
			<h4>Description</h4>
			<input id="text" type="text" name="event_description"><br>
			<h4>Data & Time</h4>
			<input id="text" type="datetime-local" name="start_date_time"><br><br>
			<input id="button" type="submit" name="createEvent" value="Create Event"><br><br>
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