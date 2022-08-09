<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="../nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../css/estilo.css">
  </head>
  <body>

  </body>
</html>

<?php
include_once("conexao.php");

session_start();
$id = $_SESSION['id'];

if(isset($_FILES['icon'])){

$ico = $_FILES['icon'];
$icoex = pathinfo($ico['name'], PATHINFO_EXTENSION);
$icodata = getdate()[0];

$iconn = "$id$icodata.$icoex";
$icodir = "../img/user_icons/";

move_uploaded_file($_FILES['icon']['tmp_name'], $icodir . $iconn);

$sql = "UPDATE users set icon='$iconn' where id='$id'";
$query = mysqli_query($conn, $sql) or die ("Erro ao atualizar ícone!");

if (mysqli_affected_rows($conn)){
  echo "<script> window.history.back() </script>";
}
else{
  echo "<script> window.alert('Erro ao atualizar ícone!') </script>";
  echo "<script> window.history.back() </script>";
}
}

?>
