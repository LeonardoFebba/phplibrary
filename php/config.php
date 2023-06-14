<?php
session_start();

$servername = "ec2-3-16-123-214.us-east-2.compute.amazonaws.com";
$username = "root";
$database = "a752378";
$password = "Senha@123";

$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}else{ 
    // echo "Connected to database successfully";
    mysqli_close($conn);
}

session_destroy();

?>