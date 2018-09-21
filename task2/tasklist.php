<?php
    //The below file contains the connection details
    include("connection_info.php");
    session_start();
    if(!$_SESSION["email"])
    {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Login to access this page');
        window.location='./login.php';
        </script>");
    }
    if($_SESSION["type"]!='admin')
    {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Unauthorized access');
        window.location='./leaderboard.php';
        </script>");
    }
?>


<!DOCTYPE html>
<html>
<head>
	<title>MANAGE TASKS</title>
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
			$Tasks=$_POST['tasks'];
			$date=$_POST['dos'];
		$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error) 
				{
					echo "<script LANGUAGE='JavaScript'>
					window.alert('Connection error')

				</script>";
				    die("Connection failed: " . $conn->connect_error);
				} 

				$sql="INSERT INTO tasks(About_task,Dos) VALUES('$Tasks','$date')";
				if($conn->query($sql))
				{
				echo "<script LANGUAGE='JavaScript'>
					window.alert('Uploaded the task successfully')
				</script>";
				}
				else
				{
					echo "<script LANGUAGE='JavaScript'>
					window.alert('Error in uploading task. Try removing quotation marks in the task description')
				</script>";
				}
		}




	?>

	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
             <span class="navbar-brand" href="#"><!-- <img src="http://mycaptain-web.herokuapp.com/static/media/logo.c0602733.png" class="logo_img"> -->WEBSTACKS</span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="leaderboard.php" class="nav-link">Leaderboard</a></li>
                <li class="nav-item active"><a href="tasklist.php" class="nav-link">Manage Tasks</a></li>
                <?php
                       //The below file contains the connection details
                        include("connection_info.php");
                        if($_SESSION["type"])
                        echo "<li class=\"nav-item\"><a href=\"admin.php\" class=\"nav-link\">Manage Users</a></li>";
                    if(!$_SESSION["email"])
                        echo "<li class=\"nav-item\"><a href=\"login.php\" class=\"nav-link\">Login</a></li><li class=\"nav-item\"><a href=\"signup.php\" class=\"nav-link\">Register</a></li>";
                    else
                        echo "<li class=\"nav-item\"><a href=\"./logout.php\" class=\"nav-link\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout&nbsp ".$_SESSION["email"]."</a></li>";
                 ?>
                
                 
                
            </ul>

    </nav>
	<div class="container">
 		<h2>Existing Tasks</h2>
	<?php


		$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error) 
				{
				    die("Connection failed: " . $conn->connect_error);
				} 

				$sqla="SELECT * from tasks";


            $result = $conn->query($sqla);

            if($result->num_rows>0)
            {
               echo "<table class=\"table table-striped table-test\">" .
                    "<tr><th>Task No.</th><th><center>Task Description</center></th></tr>";
                $position=1;                 
                while($row=$result->fetch_assoc())
                {
                     
                        global $position;
                            echo "<tr><td>".$position."</td>" .
                            
                            "<td>".$row["About_task"]."</td>"; 
                        echo "</tr>";

                        
                        
                            
                         
                        $position=$position+1;
                    }
      			echo "</table>";
            }
            else
            {
            	echo "There are currently no tasks";
            }
	?>
 <br>
		<h2>Create new task:</h2>
		<div>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="form-group">
			<label>Date of submission:</label> 
			<input type="Date" name="dos" class="form-control">
		</div>
		<div class="form-group">
			<label>Task description:</label>
			<textarea cols="10" rows="8" name="tasks" class="form-control"></textarea>
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-success">Upload</button>
		</div>
	</form>
	</div>
	</div>
</body>
</html>