<!DOCTYPE html>
<html>
<head>
	<title>Create an account</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./styles.css">
</head>
<body>

	<?php
		if ($_SERVER["REQUEST_METHOD"]=="POST")
		{
            //The below file contains the connection details
            include("connection_info.php");
			$First_name=$_POST['fname'];
			$Last_name=$_POST['lname'];
			$About=$_POST['about'];
			$Email=$_POST['email'];
			$Password=$_POST['pass'];
			$Phone=$_POST['phone'];
			$UrlLink=$_POST['urllink'];
			$Gender=$_POST['gender'];
			$nameErr=$emailErr=$passwordErr="";

			$mysqli = new mysqli($servername,$username,$password);
			$doesDBExist=$mysqli->select_db($dbname);
			$mysqli->close();
			//If DB Exists
			if($doesDBExist)
			{
				//Create connection
				$conn = new mysqli($servername,$username,$password,$dbname);
				// Check connection
				if ($conn->connect_error) 
				{
				    die("Connection failed: " . $conn->connect_error);
				} 	

				// Code to validate data must be written

				//Sending the values to the DB
				$sql = "INSERT INTO user (First_name,Last_name,About,Email,Phone,Url_link,password,Gender)
				VALUES ('".$First_name."','".$Last_name."','".$About."','".$Email."','".$Phone."','".$UrlLink."','".$Password."','".$Gender."')";

				if ($conn->query($sql) === TRUE) 
				{	
				    // echo "New record created successfully";
				    echo ("<script LANGUAGE='JavaScript'>
		        	window.alert('Account has been successfully created! Login to view the Leaderboard');
		        	window.location='./login.php';
		        	</script>");
				} 
				else 
				{	
					echo ("<script LANGUAGE='JavaScript'>
        			window.alert('Error! Either an account already exists for the given email-id or try removing any quotation marks in the text fields.');
        			</script>");
				    // echo "Provide correct details";
				}
				$conn->close();
			}
			//If DB NOT Exists then create db
			else
			{
				$conn = new mysqli($servername, $username, $password);
				// Check connection
				if ($conn->connect_error) 
				{
				    die("Connection failed: " . $conn->connect_error);
				} 

				// Create database
				$sql = "CREATE DATABASE ".$dbname;
				if ($conn->query($sql) === TRUE) 
				{
				    // echo "Database created successfully";
				} 
				else 
				{
					echo ("<script LANGUAGE='JavaScript'>
        			window.alert('Error creating database');
        			</script>");
				    // echo "Error creating database: " . $conn->error;
				}
				$conn->close();

				//Create tables

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				$conn2 = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) 
				{
					echo ("<script LANGUAGE='JavaScript'>
        			window.alert('Conn failed');
        			</script>");
				    // die("Connection failed: " . $conn->connect_error);
				} 
				if ($conn2->connect_error) 
				{
				    echo ("<script LANGUAGE='JavaScript'>
        			window.alert('Conn2 failed');
        			</script>");
				    //die("Connection failed: " . $conn->connect_error);
				} 	

				// sql to create table
				$sql = "CREATE TABLE user (
				UserID int AUTO_INCREMENT primary key ,
				Points int DEFAULT 0,
				First_name Varchar(30),
				Last_name Varchar(30),
				About Varchar(200),
				Email Varchar(50) UNIQUE,
				Phone Varchar(20),
				Url_link Varchar(50),
				password Varchar(30),
				Type Varchar(10) DEFAULT 'standard',
				Gender Varchar(6))";

				$sqlx = "CREATE TABLE tasks (
				TaskID int AUTO_INCREMENT primary key,
				About_task Varchar(400),
				Dos date
				)";

				//check if tasks table was created successfully
				if ($conn2->query($sqlx) === FALSE)
					echo ("<script LANGUAGE='JavaScript'>
        			window.alert('Failed to create tasks table');
        			</script>");
				//echo "Failed to create tasks table"; 

				//check if users table was created succesfully	    	    							
				if ($conn->query($sql) === TRUE) 
				{
				 
				    // echo "Table user created successfully";
				    //Create the record:
				    $sql = "INSERT INTO user (First_name,Last_name,About,Email,Phone,Url_link,password,Gender,Type)
				VALUES ('$First_name','$Last_name','$About','$Email','$Phone','$UrlLink','$Password','$Gender','admin')";

					if ($conn->query($sql) === TRUE) 
					{
				    // echo "New record created successfully";
		    	    echo ("<script LANGUAGE='JavaScript'>
		        	window.alert('Account has been successfully created! Login to view the Leaderboard');
		        	window.location='./login.php';
		        	</script>");

					} 
					else 
					{
				    echo ("<script LANGUAGE='JavaScript'>
        			window.alert('Error! Sorry, you cannot use any quotation marks in the input fields');
        			</script>");
					}

				    // header("location:./login.php");
				} 
				else 
				{
				    echo "Error creating users table: " . $conn->error;
				}

				$conn->close();
				$conn2->close();
			}
		}
	?>

	<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
	  	    	<span class="navbar-brand" href="#"><!-- <img src="http://mycaptain-web.herokuapp.com/static/media/logo.c0602733.png" class="logo_img"> -->WEBSTACKS</span>
    		<ul class="navbar-nav ml-auto">
      			<li class="nav-item"><a href="./leaderboard.php" class="nav-link">Leaderboard</a></li>
      			<li class="nav-item"><a href="#" class="nav-link">Tasks</a></li>
      			<li  class="nav-item"><a href="./login.php" class="nav-link">Login</a></li>
      			<li class="nav-item active"><a href="#" class="nav-link">Register</a></li>
    		</ul>
	</nav>
	<div class="container">
		<h1>Create an account:</h1>
		<br>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="form-group">
			<label>First Name:</label> 
			<input type="text" name="fname" class="form-control">
		</div>
		<div class="form-group">
			<label>Last Name:</label>
			<input type="text" name="lname" class="form-control">
		</div>
		<div class="form-group">
			<label>About:</label>
			<input type="text" name="about" class="form-control">
		</div>
		<div class="form-group">
			<label>Email:</label>
			<input type="Email" name="email" class="form-control">
		</div>	
		<div class="form-group">
			<label>Create a Password:</label>
			<input type="password" name="pass" class="form-control">
		</div>	
		<div class="form-group">
			<label>Phone:</label>
			<input type="number" name="phone" class="form-control">
		</div>
		<div class="form-group">
			<label>Online Profile Link</label>
			<input type="url" name="urllink" class="form-control">
		</div>
		<div class="form-group">
			<label>Gender</label>
			<select name="gender" class="form-control">
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success">Submit</button>
		</div>
	</form>
	</div>
</body>
</html>