<?php
    //The below file contains the connection details
    include("connection_info.php");
    session_start();
    if(!$_SESSION["email"])
    {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Login to view Leaderboard');
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
    <title>Manage Users</title>
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
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
             <span class="navbar-brand" href="#"><!-- <img src="http://mycaptain-web.herokuapp.com/static/media/logo.c0602733.png" class="logo_img"> -->WEBSTACKS</span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="leaderboard.php" class="nav-link">Leaderboard</a></li>
                <li class="nav-item"><a href="tasklist.php" class="nav-link">Manage Tasks</a></li>
                <?php
                       //The below file contains the connection details
                        include("connection_info.php");
                        if($_SESSION["type"])
                        echo "<li class=\"nav-item active\"><a href=\"admin.php\" class=\"nav-link\">Manage Users</a></li>";
                    if(!$_SESSION["email"])
                        echo "<li class=\"nav-item\"><a href=\"login.php\" class=\"nav-link\">Login</a></li><li class=\"nav-item\"><a href=\"signup.php\" class=\"nav-link\">Register</a></li>";
                    else
                        echo "<li class=\"nav-item\"><a href=\"./logout.php\" class=\"nav-link\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout&nbsp ".$_SESSION["email"]."</a></li>";
                 ?>
                
                 
                
            </ul>

    </nav>
    <div class="container">
        <h2><center>Manage Users</center></h2><br>
        <?php
            //The below file contains the connection details
            include("connection_info.php");
            // Create connection
            $conn = new mysqli($servername,$username,$password,$dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * from user order by Points desc";
            $result = $conn->query($sql);
            if($result->num_rows>0)
            {
                //output data of each row
                echo "<table class=\"table table-striped table-test\">" .
                    "<tr><th>Position</th><th>Name</th><th>Account Type</th><th>Points</th><th>Email-ID</th><th></th><th></th></tr>";
                $position=1;                
                while($row=$result->fetch_assoc())
                {
                    if($row["Type"]=='standard')
                     {
                        global $position;
                        echo "<tr>" .
                            "<td>".$position."</td>" .
                            "<td><a href=\"#\" onclick=\"toggle_visibility(".$position.")\">".$row["First_name"].' '.$row["Last_name"]."</a></td>" .
                            "<td>".$row["Type"]."</td>" .
                            "<td>".$row["Points"]."</td>" .
                            "<td>".$row["Email"]."</td>" .
                            "<td><a href=\"toggle.php?act=".$row["UserID"]."\"><button class=\"btn btn-primary btn-small\">Make as Admin</button></a></td>".
                            "<td><a href=\"del.php?del=".$row["UserID"]."\"><button class=\"btn btn-danger btn-small\">Delete User</button></a></td>".
                        "</tr>";
                        echo "<div id=".$position." style=\"display:none;\" class='jumbotron background'>".
                        "<div class=\"row\">
                            <div class=\"col-3\">
                              <img src=\"./avatar.png\" class=\"rounded-circle\">
                            </div>
                            <div class=\"col-9\">
                              <p><h1>".$row['First_name']."</h1><p><h4></b>".$row['About']."</h4>
                                <p><b>Phone Number:</b>  ".$row['Phone']."<b><p>Online Profile Link: </b><i><a href='#' class='white_font'>".$row['Url_link']."</a></i>
                                <b><p>Email ID: </b><i><a href='#' class='white_font'>".$row['Email']."</a></i>
                                <p><a href='#' onclick='toggle_visibility(".$position.")' class='white_font'>Close</a></p>
                            </div>
                            
                            </div>
                          </div>";
                        $position=$position+1;
                     }   
                }
                    echo "</table>";
            }
            else
                echo "0 results";
        ?>
            <div class="container">
			  <form action='modify.php' method="post" class="form-inline">
			      <label for="UserID" class="mb-2 mr-sm-2">Email-ID:</label>
			      <input type="email" class="form-control mb-2 mr-sm-2" id="userid" placeholder="Enter Email-ID" name="email">
			      <label for="Points" class="mb-2 mr-sm-2">Points:</label>
			      <input type="number" class="form-control mb-2 mr-sm-2" id="points" placeholder="Enter points to update" name="points">
			    <button type="submit" class="btn btn-warning mb-2">MODIFY</button>
			  </form>
			</div>

		<br><br>
		<h2><center>Admin List</center></h2>
		<br>
        <?php    
            $sql = "SELECT * from user order by Points desc";
            $result = $conn->query($sql);
            if($result->num_rows>0)
            {             	
                //output data of each row
                echo "<table class=\"table table-striped table-test\">" .
                    "<tr><th>Position</th><th>Name</th><th>Account Type</th><th>Email-ID</th></tr>";
                $position=1;       
        
                while($row=$result->fetch_assoc())
                {
                    if($row["Type"]=='admin')
                     {
                        global $position;
                        echo "<tr>" .
                            "<td>".$position."</td>" .
                            "<td><a href=\"#\" onclick=\"toggle_visibility(".$position.")\">".$row["First_name"].' '.$row["Last_name"]."</a></td>" .
                            "<td>".$row["Type"]."</td>" .
                            "<td>".$row["Email"]."</td>" .
                        "</tr>";
                        $position=$position+1;
                     }   
                }
                    echo "</table>";
            }
            else
                echo "0 results";




        $conn->close();
        ?>

    </div>


            <script type="text/javascript">
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }</script>
</body>
</html>