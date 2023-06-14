<?php

include("config.php");


session_start();

$regName = $_POST['regName'];
$register = $_POST['ra'];
$userPassword = $_POST['userPassword'];

$pattern = '/^a[0-9]{6}$/';

if(!preg_match($pattern, $register)){
    echo "O registro deve seguir o padrão <br>";
    echo "Tentar novamente <a href='../index.html'>Início";
    exit;
}

$strcon = mysqli_connect($servername, $username, $password, $database);

if(!$strcon){
    die("Something went wrong ".mysqli_connect_error());
}else{
    $createTable = "CREATE TABLE IF NOT EXISTS Cadastro(
        id INT AUTO_INCREMENT PRIMARY KEY,
        regName VARCHAR(20),
        ra VARCHAR(7),
        userPassword VARCHAR(16)
    )";

    if(mysqli_query($strcon, $createTable)){
        echo "Table created successfully";
        header("Location: ../adm.html");

        $checkQuery = "SELECT COUNT(*) AS count FROM Cadastro WHERE ra = '$register'";
        $result = mysqli_query($strcon, $checkQuery);

        if($result){
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];

            if($count > 0){
                echo "You are already registered here";
                header("Location: ../login.html");
            }else{
                $insertQuery = "INSERT INTO Cadastro (regName, ra, userPassword) VALUES ('$regName', '$register', '$userPassword')";

                if(mysqli_query($strcon, $insertQuery)){
                    header("Location:../adm.html");
                }else{
                    echo "Something went wrong: ".mysqli_connect_error($strcon);
                }
            }
        }else{
            echo "Something went wrong: ".mysqli_connect_error($strcon);
        }
    }else{
        echo "Something went wrong: ".mysqli_connect_error($strcon);
    }
}

session_destroy();

?>