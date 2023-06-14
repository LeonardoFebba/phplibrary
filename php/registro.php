<?php

include("config.php");

$conn = mysqli_connect($servername, $username, $password, $database);

$bookTitle = $_POST["bookTitle"];
$authorName = $_POST["authorName"];
$bookType = $_POST["bookType"];

if(!$conn){
    die("Something went wrong: ".mysqli_connect_error());
}else{
    $insertQuery = "INSERT INTO Livros (bookTitle, authorName, bookType) VALUES ('$bookTitle', '$authorName', '$bookType')";
    if(mysqli_query($conn, $insertQuery)){
        header("Location: ../success.html");
    }else{
        die("Something went wrong: ".mysqli_connect_error());
    }
}


?>