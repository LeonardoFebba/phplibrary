<?php
include("config.php");

$conn($servername, $username, $password, $database);

if(!$conn){
    die("Sorry, something went wrong").mysqli_connect_error();
}

?>