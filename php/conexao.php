<?php

  $servername = "localhost";
  $database = "nebula";
  $username = "root";
  $password = "root";

  //criando conexão
  $conn = mysqli_connect($servername,$username, $password, $database);

if(!$conn){
    die("Falha na conexão: ".mysqli_connect_error());
}
?>
