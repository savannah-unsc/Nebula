<?php

include_once("conexao.php");

session_start();
$id = $_SESSION["id"];
$cbval = $_POST["cbcom"];

if ($cbval == "on") {
    $sql = "UPDATE users set tipo = 1, uid = 'CMNT' where id = $id;";
  $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar perfil!");

  if (mysqli_affected_rows($conn)){
  echo "<script> location.href='../config.php'</script>";
  }
  else{
    echo "<script> location.href='../config.php'</script>";
  }
} else {
    echo "<script> location.href='../config.php'</script>";
}

?>