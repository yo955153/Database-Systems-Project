<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
	$event_data = load_events($con);

	if(isset($_POST['joinRSO']))
	{
		$rso_name = $_POST['rso_name'];
		if(!empty($rso_name))
		{
			$student_username = $user_data['student_username'];
			$query = "update students set rso_name = '$rso_name' where student_username = '$student_username'";
			mysqli_query($con, $query);

			header("Location: index.php");
			die;
		}
	}else if(isset($_POST['joinUni']))
	{
		$university_name = $_POST['university_name'];
		if(!empty($university_name))
		{
			$student_username = $user_data['student_username'];
			$query = "update students set university_name = '$university_name' where student_username = '$student_username'";
			mysqli_query($con, $query);

			header("Location: index.php");
			die;
		}
	}else if(isset($_POST['postComment']))
	{
		$event_name = $_POST['event_name'];
		$comment = $_POST['event_comment'];

		if(!empty($event_name) && !empty($comment))
		{
			$student_username = $user_data['student_username'];
			$query = "insert into comments (event_name,comment,student_username) values ('$event_name','$comment','$student_username')";
			mysqli_query($con, $query);

			header("Location: index.php");
			die;
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title >College Events</title>
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
	</style>

	<div style="text-align:right"> 
	<p>Student View</p>
	<p>Logged in as, <?php echo $user_data['student_username']; ?></p>
   
	<a href="logout.php">Logout</a>
	</div>
	<h1 style="text-align:center">College Events</h1><br>
	<h2>Register for a University:</h2><br>
	<div id="box">
		<form method="post">
			<input id="text" type="text" name="university_name"><br><br>
			<input id="button" type="submit" name="joinUni" value="Join University"><br><br>
		</form>
	</div>
	<br>
	<h2>Register for an RSO:</h2><br>
	<div id="box">
		<form method="post">
			<input id="text" type="text" name="rso_name"><br><br>
			<input id="button" type="submit" name="joinRSO" value="Join RSO"><br><br>
		</form>
	</div>
	<br>
	<h2>Comment on an Event:</h2>
	<br>
	<div id="box">
		<form method="post">
			<h4>Event Name</h4>
			<input id="text" type="text" name="event_name"><br>
			<h4>Comment</h4>
			<input id="text" type="text" name="event_comment"><br>
			<input id="button" type="submit" name="postComment" value="Post Comment"><br><br>
		</form>
	</div>
	<br><br>
	<h2>Upcoming Events:</h2><br>
	<h3>Public Events:</h3>
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
	<h3>Private University Events:</h3>
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
	<h3>Private RSO Events:</h3>
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
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.911485963419!2d-81.20224858450524!3d28.602432092192654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88e7685d6a0a495f%3A0x5fd59b92b3c79bab!2sUniversity%20of%20Central%20Florida!5e0!3m2!1sen!2sus!4v1618676497316!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

</body>
</html>