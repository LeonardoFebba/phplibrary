<?php
include("config.php");

$login = $_POST['login'];
$loginPassword = $_POST['loginPassword'];

$conn = mysqli_connect($servername, $username, $password, $database);

$checkLogin = "SELECT * FROM Cadastro WHERE ra = '$login' AND userPassword = '$loginPassword'";
$result = mysqli_query($conn, $checkLogin);

if($result && mysqli_num_rows($result) > 0){
    header("Location: ../adm.html");
}else{
    echo "Credenciais inválidas <br>";
    echo "Para tentar o login novamente, <a href='../login.html'>clique aqui</a>";
}

mysqli_close($conn);

?>