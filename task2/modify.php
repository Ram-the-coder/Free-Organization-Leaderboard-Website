<?php

{
            //The below file contains the connection details
            include("connection_info.php");
			$Email=$_POST['email'];
			$Points=$_POST['points'];

			// Create connection
			$conn = new mysqli($servername,$username,$password,$dbname);
			// Check connection
			if ($conn->connect_error) 
			{
			    die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "UPDATE user SET Points=$Points where Email='$Email'";
			$result = $conn->query($sql);
			if($result)
			{
				echo ("<script LANGUAGE='JavaScript'>
	        	window.alert('Points have been successfully modified for specified user');
	        	window.location='./admin.php';
	        	</script>");
			}
			else
			{
				echo ("<script LANGUAGE='JavaScript'>
	        	window.alert('Unable to modify points for the specified user');
	        	window.location='./admin.php';
	        	</script>");
			}
		}

?>