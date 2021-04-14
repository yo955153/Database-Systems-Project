<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$rso_name = $_POST['rso_name'];
		$event_type = $_POST['event_type'];
		$event_name = $_POST['event_name'];
		$event_description = $_POST['event_description'];

		if(!empty($rso_name) && !empty($event_type) && !empty($event_name) && !empty($event_description))
		{

			//save to database
			$query = "insert into events (rso_name,event_type,event_name,event_description) values ('$rso_name','$event_type','$event_name','$event_description')";

			mysqli_query($con, $query);

			header("Location: admin-index.php");
			die;
			
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
			float: left;
			background-color: grey;
			margin: auto;
			width: 300px;
			padding: 20px;
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
			<input id="text" type="text" name="rso_name"><br><br>
			<input id="text" type="text" name="event_type"><br><br>
			<input id="text" type="text" name="event_name"><br><br>
			<input id="text" type="text" name="event_description"><br><br>
			<input id="button" type="submit" value="Create Event"><br><br>
		</form>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

	<h2>Upcoming Events:</h2>
	

</body>
</html>