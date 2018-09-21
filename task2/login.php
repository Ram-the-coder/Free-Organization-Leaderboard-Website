<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
            $mysqli = new mysqli($servername,$username,$password);
			$doesDBExist=$mysqli->select_db($dbname);
			$mysqli->close();
			if(!$doesDBExist)
			{
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('User does not exist. Register to login');
        window.location='./signup.php';
        </script>");
			}
			else{
			$email=$_POST['emailid'];
			$Pwd=$_POST['pass'];

			// Create connection
			$conn = new mysqli($servername,$username,$password,$dbname);
			// Check connection
			if ($conn->connect_error) 
			{
			    die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "SELECT count(*) FROM  user where Email='".$email."'";
			$result = $conn->query($sql);
			$var=0;
			if ($result->num_rows > 0) 
			{
			    $row = $result->fetch_assoc();
			    global $var;
			    $var=$row["count(*)"];
			}

			if($var)
			{

				$sql = "SELECT count(Email),Type FROM  user where password=(select password from user where password='".$Pwd."' and Email='".$email."')";
				$result = $conn->query($sql);
				$var=0;
				if ($result->num_rows>0)
				{
			 	   $row = $result->fetch_assoc();
			    	global $var;
			    	$var=$row['count(Email)'];
			    	$act=$row['Type'];
				}

				if($var)
				{
					
					$_SESSION["email"]=$email;
					$_SESSION["type"]=$act;
					header("location:./leaderboard.php");
				}
				else
				{
				echo '<script language="javascript">';
				echo 'alert("ENTER CORRECT PASSWORD")';
				echo '</script>';
				}
			}
			else
				{
				echo '<script language="javascript">';
				echo 'alert("ENTER CORRECT EMAIL ID")';
				echo '</script>';
				}
			
			$conn->close();
		}
		}
	?>

	
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
	  	    	<span class="navbar-brand" href="#"><!-- <img src="http://mycaptain-web.herokuapp.com/static/media/logo.c0602733.png" class="logo_img"> -->WEBSTACKS</span>
    		<ul class="navbar-nav navbar-right ml-auto">
      			<li class="nav-item"><a href="./leaderboard.php" class="nav-link">Leaderboard</a></li>
      			<li class="nav-item"><a href="./utask.php" class="nav-link">Tasks</a></li>
      			<li  class="nav-item active"><a href="#" class="nav-link">Login</a></li>
      			<li class="nav-item"><a href="./signup.php" class="nav-link">Register</a></li>
    		</ul>
	</nav>
	<div class="container login">
		<div class=""><h1>Login</h1></div>
		<br>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="form-group">
			<label>Email:</label> 
			<input type="Email" name="emailid" class="form-control">
		</div>
		<div class="form-group">
			<label>Password:</label>
			<input type="Password" name="pass" class="form-control">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success">Submit</button>
		</div>
	</form>
	</div>

</body>
</html>