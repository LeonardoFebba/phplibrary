<?php
session_start();

$servername = "serverName";
$username = "root";
$database = "serverUsername";
$password = "serverPassword";

$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}else{ 
    // echo "Connected to database successfully";
    mysqli_close($conn);
}

session_destroy();

?>
