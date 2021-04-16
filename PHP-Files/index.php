<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
	$event_data = load_events($con);

	if($_SERVER['REQUEST_METHOD'] == "POST")
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
	</style>

	<div style="text-align:right"> 
	<p>Student View</p>
	<p>Logged in as, <?php echo $user_data['student_username']; ?></p>
   
	<a href="logout.php">Logout</a>
	</div>
	<h1 style="text-align:center">College Events</h1><br>
	<h2>Register for an RSO:</h2><br>
	<div id="box">
		<form method="post">
			<input id="text" type="text" name="rso_name"><br><br>
			<input id="button" type="submit" value="Join RSO"><br><br>
		</form>
	</div>
	<br>
	<h2>Upcoming Events:</h2><br>
	<h3>Public Events:</h3>
	<p><?php 
	echo "<table border ='1px'>";
	while($event = mysqli_fetch_array($event_data))
	{
		if($event['event_type'] == 'Public')
		{
			echo "<tr>";
			echo "<td> {$event['rso_name']} </td>";
			echo "<td> {$event['event_type']} </td>";
			echo "<td> {$event['event_name']} </td>";
			echo "<td> {$event['event_description']} </td>";
			echo "<td> {$event['start_date_time']} </td>";
			echo "</tr>";
		}
	}
	echo "</table>"; ?></p>
	<h3>Private University Events:</h3>
	<p><?php echo "<table border ='1px'>";
	$event_data = load_events($con);
	while($event = mysqli_fetch_array($event_data))
	{
		if($event['event_type'] == 'Private_Uni')
		{
			echo "<tr>";
			echo "<td> {$event['rso_name']} </td>";
			echo "<td> {$event['event_type']} </td>";
			echo "<td> {$event['event_name']} </td>";
			echo "<td> {$event['event_description']} </td>";
			echo "<td> {$event['start_date_time']} </td>";
			echo "</tr>";
		}
	}
	echo "</table>"; ?></p>
	<h3>Private RSO Events:</h3>
	<p><?php echo "<table border ='1px'>";
	$event_data = load_events($con);
	while($event = mysqli_fetch_array($event_data))
	{
		if($event['event_type'] == 'Private_RSO')
		{
			if($event['rso_name'] == $user_data['rso_name'])
			{
				echo "<tr>";
				echo "<td> {$event['rso_name']} </td>";
				echo "<td> {$event['event_type']} </td>";
				echo "<td> {$event['event_name']} </td>";
				echo "<td> {$event['event_description']} </td>";
				echo "<td> {$event['start_date_time']} </td>";
				echo "</tr>";
			}
			
		}
	}
	echo "</table>"; ?></p>

</body>
</html>