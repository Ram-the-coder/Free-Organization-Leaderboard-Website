<?php
    //The below file contains the connection details
    include("connection_info.php");
     $mysqli = new mysqli($servername,$username,$password);
    $doesDBExist=$mysqli->select_db($dbname);
    $mysqli->close();
    if(!$doesDBExist)
    {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Register to login and view Leaderboard');
        window.location='./signup.php';
        </script>");
    }
    else
    {
        session_start();
        if(!$_SESSION["email"])
        {
          echo ("<script LANGUAGE='JavaScript'>
          window.alert('Login to view Leaderboard');
          window.location='./login.php';
          </script>");
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
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
<body class="">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <span class="navbar-brand" href="#"><!-- <img src="http://mycaptain-web.herokuapp.com/static/media/logo.c0602733.png" class="logo_img"> -->WEBSTACKS</span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="#" class="nav-link"><span class="glyphicon glyphicon-list-alt"></span> Leaderboard</a></li>
                <?php
                       //The below file contains the connection details
                        include("connection_info.php");
                        if($_SESSION["type"]=='standard')
                        echo "<li class='nav-item'><a href='utask.php' class='nav-link'>Tasks</a></li>";
                        else
                            echo "<li class='nav-item'><a href='tasklist.php' class='nav-link'>Manage Tasks</a></li>";
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
            //The below file contains the connection details
            include("connection_info.php");
            // Create connection
            $conn = new mysqli($servername,$username,$password,$dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            echo "<h2><center>LEADERBOARD</center></h2><BR>";
            $sqla = "SELECT * from user WHERE Type='standard' order by Points desc";
            $temp=1;
            $result = $conn->query($sqla);
            if($result->num_rows>0)
            {
                echo "<div><table class=\"table table-striped table-test\">" .
                    "<tr><th>Position</th><th>Name</th><th>Points</th><th></th></tr>";
                $position=1;                
                while($row=$result->fetch_assoc())
                {
                     
                        global $position;
                        echo "<tr class='black_font' style=";
                        if($position==1)
                            echo "\"background: linear-gradient(yellow 10%,orange)\"";
                        elseif ($position==2)
                            echo "\"background: linear-gradient(white,#a6a6a6)\"";
                        else if ($position==3)
                            echo "\"background: linear-gradient(#ff9933 10%,#c24901)\"";
                        echo ">" .
                            "<td";
                            echo ">".$position."</td>" .
                            "<td><a href=\"#\" onclick=\"toggle_visibility(".$position.")\" class='black_font'>".$row["First_name"].' '.$row["Last_name"]."</a></td>" .
                            "<td>".$row["Points"]."</td>"; 
                            if($position==1)
                                echo "<td><img src='./gold.svg' width='30'></td>";
                            elseif($position==2)
                                echo "<td><img src='./silver.svg' width='30'></td>";
                            elseif($position==3)
                                echo "<td><img src='./bronze.svg' width='30'></td>";
                            else
                                echo "<td></td>";
                        echo "</tr>";

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
                    echo "</table></div>";
            }
            else
                echo "0 results";

        $conn->close();
        ?>
        <script type="text/javascript">
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
    // function topper(id){
    //     var e = document.getElementById(id);
    //     if(e==1)
    //     {
    //         e.style.background == linear-gradient(yellow,orange);
    //     }
    //     if(e==2)
    //     {
    //         e.style.background == linear-gradient(white,grey);
    //     }
    //     if(e==3)
    //     {
    //         e.style.background == linear-gradient(orange,red);
    //     }
    // }
    </script>
    </div>
</body>
</html>