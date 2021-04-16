<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
	$event_data = load_events($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>College Events</title>
</head>
<body>
	<div style="text-align:right"> 
	<p>Super Admin View</p>
	<p>Logged in as, <?php echo $user_data['university_name'] ?? ""; ?></p>
   
	<a href="logout.php">Logout</a>
	</div>
	<h1 style="text-align:center">College Events</h1>
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
			echo "<td> {$event['university_name']} </td>";
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
			echo "<td> {$event['university_name']} </td>";
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
				echo "<td> {$event['university_name']} </td>";
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