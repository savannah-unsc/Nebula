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
$idconvidado = $_POST['id'];

if ($id > $idconvidado) {
  $idmaior = $id;
  $idmenor = $idconvidado;
} else {
  $idmaior = $idconvidado;
  $idmenor = $id;
}

$sql = "select * from follow where idmaior='$idmaior' and idmenor='$idmenor'";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$maiormenor = $tabela["maiormenor"];
$menormaior = $tabela["menormaior"];
}

if (isset($maiormenor)) {
  if ($id == $idmaior) {
    switch ($maiormenor) {
      case '0':
      $sql = "UPDATE follow set maiormenor='1' where idmaior = $idmaior and idmenor = $idmenor";
      $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro ao seguir usuário.') </script> <script> window.history.back() </script>");
      if (mysqli_affected_rows($conn)){
        $sql = "select * from users where id='$idmaior'";
        $result=mysqli_query($conn,$sql);
        while($tabela=mysqli_fetch_array($result))
        {
          $seguindo = $tabela["seguindo"];
        }
        $sql = "select * from users where id='$idmenor'";
        $result=mysqli_query($conn,$sql);
        while($tabela=mysqli_fetch_array($result))
        {
          $seguidores = $tabela["seguidores"];
        }
        $seguindo = $seguindo + 1;
        $seguidores = $seguidores + 1;
        $sql = "UPDATE users set seguindo='$seguindo' where id='$idmaior'";
        $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
        $sql = "UPDATE users set seguidores='$seguidores' where id='$idmenor'";
        $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
        if (mysqli_affected_rows($conn)){
          echo "<script> window.history.back() </script>";
        }
      }
      else {
        echo "<script> window.alert('Erro ao seguir usuário.') </script>";
        echo "<script> window.history.back() </script>";
      }
      break;
      case '1':
      $sql = "UPDATE follow set maiormenor='0' where idmaior = $idmaior and idmenor = $idmenor";
      $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro ao seguir usuário.') </script> <script> window.history.back() </script>");
      if (mysqli_affected_rows($conn)){
        $sql = "select * from users where id='$idmaior'";
        $result=mysqli_query($conn,$sql);
        while($tabela=mysqli_fetch_array($result))
        {
          $seguindo = $tabela["seguindo"];
        }
        $sql = "select * from users where id='$idmenor'";
        $result=mysqli_query($conn,$sql);
        while($tabela=mysqli_fetch_array($result))
        {
          $seguidores = $tabela["seguidores"];
        }
        $seguindo = $seguindo - 1;
        $seguidores = $seguidores - 1;
        $sql = "UPDATE users set seguindo='$seguindo' where id='$idmaior'";
        $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
        $sql = "UPDATE users set seguidores='$seguidores' where id='$idmenor'";
        $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
        if (mysqli_affected_rows($conn)){
          echo "<script> window.history.back() </script>";
        }
      }
      else {
        echo "<script> window.alert('Erro ao seguir usuário.') </script>";
        echo "<script> window.history.back() </script>";
      }
      break;
    }
  } else {
    switch ($menormaior) {
      case '0':
      $sql = "UPDATE follow set menormaior='1' where idmaior = $idmaior and idmenor = $idmenor";
      $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro ao seguir usuário.') </script> <script> window.history.back() </script>");
      if (mysqli_affected_rows($conn)){
        $sql = "select * from users where id='$idmenor'";
        $result=mysqli_query($conn,$sql);
        while($tabela=mysqli_fetch_array($result))
        {
          $seguindo = $tabela["seguindo"];
        }
        $sql = "select * from users where id='$idmaior'";
        $result=mysqli_query($conn,$sql);
        while($tabela=mysqli_fetch_array($result))
        {
          $seguidores = $tabela["seguidores"];
        }
        $seguindo = $seguindo + 1;
        $seguidores = $seguidores + 1;
        $sql = "UPDATE users set seguindo='$seguindo' where id='$idmenor'";
        $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
        $sql = "UPDATE users set seguidores='$seguidores' where id='$idmaior'";
        $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
        if (mysqli_affected_rows($conn)){
          echo "<script> window.history.back() </script>";
        }
      }
      else {
        echo "<script> window.alert('Erro ao seguir usuário.') </script>";
        echo "<script> window.history.back() </script>";
      }
      break;
      case '1':
      $sql = "UPDATE follow set menormaior='0' where idmaior = $idmaior and idmenor = $idmenor";
      $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro ao seguir usuário.') </script> <script> window.history.back() </script>");
      if (mysqli_affected_rows($conn)){
        $sql = "select * from users where id='$idmenor'";
        $result=mysqli_query($conn,$sql);
        while($tabela=mysqli_fetch_array($result))
        {
          $seguindo = $tabela["seguindo"];
        }
        $sql = "select * from users where id='$idmaior'";
        $result=mysqli_query($conn,$sql);
        while($tabela=mysqli_fetch_array($result))
        {
          $seguidores = $tabela["seguidores"];
        }
        $seguindo = $seguindo - 1;
        $seguidores = $seguidores - 1;
        $sql = "UPDATE users set seguindo='$seguindo' where id='$idmenor'";
        $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
        $sql = "UPDATE users set seguidores='$seguidores' where id='$idmaior'";
        $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
        if (mysqli_affected_rows($conn)){
          echo "<script> window.history.back() </script>";
        }
      }
      else {
        echo "<script> window.alert('Erro ao seguir usuário.') </script>";
        echo "<script> window.history.back() </script>";
      }
      break;
    }
  }
} else {
  if ($id == $idmaior) {
    $sql = "INSERT INTO follow (idmaior, idmenor, maiormenor) values('$idmaior', '$idmenor', '1')";
    $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro ao seguir usuário.') </script> <script> window.history.back() </script>");
    if (mysqli_affected_rows($conn)){
      $sql = "select * from users where id='$idmaior'";
      $result=mysqli_query($conn,$sql);
      while($tabela=mysqli_fetch_array($result))
      {
        $seguindo = $tabela["seguindo"];
      }
      $sql = "select * from users where id='$idmenor'";
      $result=mysqli_query($conn,$sql);
      while($tabela=mysqli_fetch_array($result))
      {
        $seguidores = $tabela["seguidores"];
      }
      $seguindo = $seguindo + 1;
      $seguidores = $seguidores + 1;
      $sql = "UPDATE users set seguindo='$seguindo' where id='$idmaior'";
      $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
      $sql = "UPDATE users set seguidores='$seguidores' where id='$idmenor'";
      $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
      if (mysqli_affected_rows($conn)){
        echo "<script> window.history.back() </script>";
      }
    }
    else {
      echo "<script> window.alert('Erro ao seguir usuário.') </script>";
      echo "<script> window.history.back() </script>";
    }
  } else {
    $sql = "INSERT INTO follow (idmaior, idmenor, menormaior) values('$idmaior', '$idmenor', '1')";
    $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro ao seguir usuário.') </script> <script> window.history.back() </script>");
    if (mysqli_affected_rows($conn)){
      $sql = "select * from users where id='$idmenor'";
      $result=mysqli_query($conn,$sql);
      while($tabela=mysqli_fetch_array($result))
      {
        $seguindo = $tabela["seguindo"];
      }
      $sql = "select * from users where id='$idmaior'";
      $result=mysqli_query($conn,$sql);
      while($tabela=mysqli_fetch_array($result))
      {
        $seguidores = $tabela["seguidores"];
      }
      $seguindo = $seguindo + 1;
      $seguidores = $seguidores + 1;
      $sql = "UPDATE users set seguindo='$seguindo' where id='$idmenor'";
      $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
      $sql = "UPDATE users set seguidores='$seguidores' where id='$idmaior'";
      $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");
      if (mysqli_affected_rows($conn)){
        echo "<script> window.history.back() </script>";
      }
    }
    else {
      echo "<script> window.alert('Erro ao seguir usuário.') </script>";
      echo "<script> window.history.back() </script>";
    }
  }
}

?>
