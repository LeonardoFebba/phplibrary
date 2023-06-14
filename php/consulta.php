<?php
include("config.php");

session_start();

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Something went wrong: ".mysqli_connect_erro());
}else{
    $sql = "CREATE TABLE IF NOT EXISTS Livros(
        id INT AUTO_INCREMENT PRIMARY KEY,
        bookTitle VARCHAR(50),
        authorName VARCHAR(20),
        bookType VARCHAR(20)
    )";

    if(mysqli_query($conn, $sql)){
        // echo "Table create successfully"."<br>";
    }else{
        die("Something went wrong: ".mysqli_connect_error());
    }
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $livroID = $_POST["id"];
    $deleteQuery = "DELETE FROM Livros WHERE id = '$livroID'";

    if(mysqli_query($conn, $deleteQuery)){
        echo "O livro foi deletado com sucesso! <br>";
        echo "<br>";
    }else{
        die("Something went wrong: ".mysqli_connect_error());
    }
}

$query = "SELECT * FROM Livros";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "ID: ".$row["id"] . "<br>";
        echo "Título: ".$row["bookTitle"]. "<br>";
        echo "Autor: ".$row["authorName"]. "<br>";
        echo "-----------------------------<br>";
        echo "<form action='' method='POST'>";
        echo "<input type='hidden' name='id' value='".$row["id"]."'>";
        echo "<button type='submit'>Excluir</button>";
        echo "</form>";
    }

    echo "Para cadastrar outro, siga para: <a href='../registro.html'>Cadastar</a>";
    
}else{
    if(!empty($query)){
        $truncate = "TRUNCATE TABLE Livros";
        echo "Não há itens disponíveis<br>";
        if(mysqli_query($conn, $truncate)){
            $resetID = "ALTER TABLE Livros AUTO_INCREMENT = 1";
            mysqli_query($conn, $resetID);
        }else{
            echo "Something went wrong: ".mysqli_connect_error();
        }
    }

    echo "Caso queira cadastrar algum livro, comece por aqui: <a href='../registro.html'>Cadastar</a>";
}


?>