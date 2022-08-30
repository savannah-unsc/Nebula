<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
  </head>
  <body>

  </body>
</html>

<?php
include_once("conexao.php");

session_start();
$id = $_SESSION['id'];
$postid = $_POST['postid'];

$sql = "SELECT * from likes where usuario = $id and post = $postid";
$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$validade = $tabela["id"];
}

if (isset($validade) == true) {
    $sql = "delete from likes where usuario = $id and post = $postid";
    $query = mysqli_query($conn, $sql) or die ("");
    
    $sql = "SELECT * from posts where id = $postid";
    $result=mysqli_query($conn,$sql);
    while($tabela=mysqli_fetch_array($result))
    {
        $curtidas = $tabela["curtidas"];
        $curtidas = $curtidas - 1;
    }
    $sql = "UPDATE posts set curtidas='$curtidas' where id='$postid'";
    $query = mysqli_query($conn, $sql) or die ("Erro!");

    if (mysqli_affected_rows($conn)){
      echo "<script> window.close() </script>";
    }
    else{
    echo "<script> window.alert('Erro!') </script>";
    echo "<script> window.close() </script>";
    }
} else {
    $sql = "INSERT INTO likes (usuario, post) values($id, $postid)";
    $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro') </script> <script> window.history.back() </script>");
    if (mysqli_affected_rows($conn)){}
    
    $sql = "SELECT * from posts where id = $postid";
    $result=mysqli_query($conn,$sql);
    while($tabela=mysqli_fetch_array($result))
    {
        $curtidas = $tabela["curtidas"];
        $curtidas = $curtidas + 1;
    }
    $sql = "UPDATE posts set curtidas='$curtidas' where id='$postid'";
    $query = mysqli_query($conn, $sql) or die ("Erro!");

    if (mysqli_affected_rows($conn)){
    echo "<script> window.close() </script>";
    }
    else{
    echo "<script> window.alert('Erro!') </script>";
    echo "<script> window.close() </script>";
    }
}


?>