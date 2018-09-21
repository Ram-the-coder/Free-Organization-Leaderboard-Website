<?php
    //The below file contains the connection details
    include("connection_info.php");
    session_start();
    session_destroy();
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('You have been successfully logged out');
    window.location='./login.php';
    </script>");
?>