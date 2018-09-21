<?php
	//The below file contains the connection details
	include("connection_info.php");
	$act=$_GET['act'];
	$conn = new mysqli($servername,$username,$password,$dbname);
	// Check connection
	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	} 	
	$sql="UPDATE user SET Type='admin' WHERE UserID='$act'";
	if($conn->query($sql))
	{
		echo ("<script LANGUAGE='JavaScript'>
		window.alert('The user has been successfully changed to admin');
		window.location='./admin.php';
		</script>");	
	}
	echo ("<script LANGUAGE='JavaScript'>
	window.alert('Unknown error in deleting the user');
	window.location='./admin.php';
	</script>");

?>