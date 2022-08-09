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

if(isset($_FILES['banner'])){

$ban = $_FILES['banner'];
$banex = pathinfo($ban['name'], PATHINFO_EXTENSION);
$bandata = getdate()[0];

$bannn = "$id$bandata.$banex";
$bandir = "../img/user_banners/";

move_uploaded_file($_FILES['banner']['tmp_name'], $bandir . $bannn);

$sql = "UPDATE users set banner='$bannn' where id='$id'";
$query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");

if (mysqli_affected_rows($conn)){
  echo "<script> window.history.back() </script>";
}
else{
  echo "<script> window.alert('Erro ao atualizar banner!') </script>";
  echo "<script> window.history.back() </script>";
}
}

?>
