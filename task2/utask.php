<?php
    //The below file contains the connection details
    include("connection_info.php");
     $mysqli = new mysqli($servername,$username,$password);
    $doesDBExist=$mysqli->select_db($dbname);
    $mysqli->close();
    if(!$doesDBExist)
    {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Register to login and view Tasks');
        window.location='./signup.php';
        </script>");
    }
    else
    {
        session_start();
        if(!$_SESSION["email"])
        {
          echo ("<script LANGUAGE='JavaScript'>
          window.alert('Login to view Tasks');
          window.location='./login.php';
          </script>");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
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
                <li class="nav-item"><a href="leaderboard.php" class="nav-link"><span class="glyphicon glyphicon-list-alt"></span> Leaderboard</a></li>
                <li class="nav-item active"><a href="#" class="nav-link">Tasks</a></li>
                <?php
                       //The below file contains the connection details
                        include("connection_info.php");
                        if($_SESSION["type"]=='admin')
                        echo "<li class=\"nav-item\"><a href=\"admin.php\" class=\"nav-link\"><span class='glyphicon glyphicon-cog'></span> Manage Users</a></li>";
                    if(!$_SESSION["email"])
                        echo "<li class=\"nav-item\"><a href=\"login.php\" class=\"nav-link\"><span class='.glyphicon-glyphicon-log-in'></span>Login</a></li><li><a href=\"signup.php\">Register</a></li>";
                    else
                        echo "<li class=\"nav-item\"><a href=\"./logout.php\" class=\"nav-link\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout&nbsp ".$_SESSION["email"]."</a></li>";
                 ?>
            </ul>
    </nav>
    <div class="container">
        <?php
            include("connection_info.php");
            // Create connection
            $conn = new mysqli($servername,$username,$password,$dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sqla = "SELECT * from tasks";
            
            $result = $conn->query($sqla);

            if($result->num_rows>0)
            {
                $position=1;                
                while($row=$result->fetch_assoc())
                {
                     
                 echo "<div class='media border p-3'>
                <img src='./taskimg.jpg' class='mr-3 mt-3 rounded-circle' style='width:60px;'>
                <div class='media-body'>
                    <h4>Task#".$position."<small><i>&nbsp Due on ".$row['Dos']."</i></small></h4>
                    <p>".$row['About_task']."</p>
                </div>
             </div><br>";             
                    $position+=1;
                }
            
            }
            else
                echo "Tasks will be uploaded soon. Stay tuned!"
        ?>
    </div>
</body>
</html>