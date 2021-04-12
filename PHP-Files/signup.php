<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['username'];
		$password = $_POST['password'];
		$login_type = $_POST['login_type'];

		if(!empty($user_name) && !empty($password))
		{
			if(($login_type == "Student") || ($login_type == "student"))
			{
				//save to database
				$student_name = $user_name;
				$student_password = $password;
				$query = "insert into students (student_username,student_password) values ('$student_name','$student_password')";

				mysqli_query($con, $query);

				header("Location: login.php");
				die;
			}
			else if(($login_type == "RSO") || ($login_type == "rso"))
			{
				$rso_name = $user_name;
				$rso_password = $password;
				$query = "insert into admin (rso_name,rso_password) values ('$rso_name','$rso_password')";

				mysqli_query($con, $query);

				header("Location: login.php");
				die;
			}
			else if(($login_type == "University") || ($login_type == "university"))
			{
				$university_name = $user_name;
				$university_password = $password;
				$query = "insert into new_super_admin (university_name,university_password) values ('$university_name','$university_password')";

				mysqli_query($con, $query);

				header("Location: login.php");
				die;
			}else
			{
				echo "Please enter valid login type!";
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
	<title>Signup</title>
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
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 30px;color: white;">Signup</div>
			<p style="font-size: 20px;color: white;">Account Type:</p>

			<input id="text" type="text" name="login_type"><br><br>
			<p style="font-size: 20px;color: white;">Username: </p>

			<input id="text" type="text" name="username"><br><br>
			<p style="font-size: 20px;color: white;">Password: </p>

			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php"  style="text-decoration:none;" id = "button" type = "submit">Login</a><br><br>
		</form>
	</div>
</body>
</html>