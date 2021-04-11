<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['student_username'];
		$password = $_POST['student_password'];
		$login_type = $_POST['login_type'];

		if(!empty($user_name) && !empty($password))
		{
			if(($login_type == "Student") || ($login_type == "student"))
			{
				//read from database
				$query = "select * from students where student_username = '$user_name' limit 1";
				$result = mysqli_query($con, $query);

				if($result)
				{
					if($result && mysqli_num_rows($result) > 0)
					{

						$user_data = mysqli_fetch_assoc($result);
						
						if($user_data['student_password'] === $password)
						{

							$_SESSION['student_id'] = $user_data['student_id'];
							header("Location: index.php");
							die;
						}
					}
				}
			}else if(($login_type == "RSO") || ($login_type == "rso"))
			{
				//read from database
				$query = "select * from admin where rso_name = '$user_name' limit 1";
				$result = mysqli_query($con, $query);

				if($result)
				{
					if($result && mysqli_num_rows($result) > 0)
					{

						$user_data = mysqli_fetch_assoc($result);
						
						if($user_data['rso_password'] === $password)
						{

							$_SESSION['rso_id'] = $user_data['rso_id'];
							header("Location: index.php");
							die;
						}
					}
				}
			}else if(($login_type == "University") || ($login_type == "university"))
			{
				//read from database
				$query = "select * from super_admin where university_name = '$user_name' limit 1";
				$result = mysqli_query($con, $query);

				if($result)
				{
					if($result && mysqli_num_rows($result) > 0)
					{

						$user_data = mysqli_fetch_assoc($result);
						
						if($user_data['university_password'] === $password)
						{

							$_SESSION['super_admin_id'] = $user_data['super_admin_id'];
							header("Location: index.php");
							die;
						}
					}
				}
			}
			
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="login_type"><br><br>
			<input id="text" type="text" name="student_username"><br><br>
			<input id="text" type="password" name="student_password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>