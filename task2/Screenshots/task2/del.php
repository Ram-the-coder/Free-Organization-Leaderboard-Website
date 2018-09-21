<?php
	//The below file contains the connection details
	include("connection_info.php");
	$delete_id=$_GET['del'];
	$conn = new mysqli($servername,$username,$password,$dbname);
	// Check connection
	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	} 	
	$sql="DELETE FROM user WHERE UserID='$delete_id'";
	if($conn->query($sql))
	{
		echo ("<script LANGUAGE='JavaScript'>
		window.alert('The user has been deleted');
		window.location='./admin.php';
		</script>");	
	}
	echo ("<script LANGUAGE='JavaScript'>
	window.alert('Unknown error in deleting the user');
	window.location='./admin.php';
	</script>");

?>