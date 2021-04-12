<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title >College Events</title>
</head>
<body>
	<div style="text-align:right"> 
	<p>Student View</p>
	<p>Logged in as, <?php echo $user_data['student_username']; ?></p>
   
	<a href="logout.php">Logout</a>
	</div>
	<h1 style="text-align:center">College Events</h1>
	<br>
	<h2>Upcoming Events:</h2>
	

</body>
</html>