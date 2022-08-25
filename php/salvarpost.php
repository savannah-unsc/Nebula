<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title> Nebula | Entrar </title>
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
$postid = $_POST['postarsalvar'];

$sql = "SELECT * from salvos where user_id = $id and post_id = $postid";
$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$validade = $tabela["id"];
}

if (isset($validade) == true) {
    $sql = "delete from salvos where user_id = $id and post_id = $postid";
    $query = mysqli_query($conn, $sql) or die ("");
    echo "<script> window.history.back() </script>";
} else {
    $sql = "INSERT INTO salvos (user_id, post_id) values($id, $postid)";
    $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro') </script> <script> window.history.back() </script>");
    if (mysqli_affected_rows($conn)){
    echo "<script> window.history.back() </script>";
    }
}

?>