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
include ("conexao.php");

$email = hash('sha256', $_POST['login']);
$senha = hash('sha256', $_POST['password']);

$sql = "select * from login where email='$email' and senha='$senha'";
$query = mysqli_query($conn, $sql) or die ("Email ou Senha incorretos!");

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$id = $tabela["id"];
}
if (mysqli_affected_rows($conn)){
}
else{
echo "<script> window.alert('Email ou Senha incorretos!') </script>";
echo "<script> window.history.back() </script>";
}


if (isset($id) == true) {
$sql = "select * from follow where idmaior=$id";
$query = mysqli_query($conn, $sql) or die ("Erro!");

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
  $idmenor = $tabela["idmenor"];
  $maiormenor = $tabela["maiormenor"];
  $menormaior = $tabela["menormaior"];

  if ($maiormenor == 1) {
    $sqla = "select * from users where id='$idmenor'";
  $resultado=mysqli_query($conn,$sqla);
  while($tabela=mysqli_fetch_array($resultado))
  {
    $seguindo = $tabela["seguindo"];
  }
  $seguindo = $seguindo - 1;
  $sqlb = "UPDATE users set seguindo='$seguindo' where id='$idmenor'";
  $query = mysqli_query($conn, $sqlb) or die ("Erro");  
  }

  if ($menormaior == 1) {
    $sqla = "select * from users where id='$idmenor'";
  $resultado=mysqli_query($conn,$sqla);
  while($tabela=mysqli_fetch_array($resultado))
  {
    $seguidores = $tabela["seguidores"];
  }
  $seguidores = $seguidores - 1;
  $sqlb = "UPDATE users set seguidores='$seguidores' where id='$idmenor'";
  $query = mysqli_query($conn, $sqlb) or die ("Erro");  
  }  

}

$sql = "select * from follow where idmenor=$id";
$query = mysqli_query($conn, $sql) or die ("Erro!");

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
  $idmaior = $tabela["idmaior"];
  $maiormenor = $tabela["maiormenor"];
  $menormaior = $tabela["menormaior"];

  if ($maiormenor == 1) {
    $sqla = "select * from users where id='$idmaior'";
  $resultado=mysqli_query($conn,$sqla);
  while($tabela=mysqli_fetch_array($resultado))
  {
    $seguindo = $tabela["seguindo"];
  }
  $seguindo = $seguindo - 1;
  $sqlb = "UPDATE users set seguindo='$seguindo' where id='$idmaior'";
  $query = mysqli_query($conn, $sqlb) or die ("Erro");  
  }

  if ($menormaior == 1) {
    $sqla = "select * from users where id='$idmaior'";
  $resultado=mysqli_query($conn,$sqla);
  while($tabela=mysqli_fetch_array($resultado))
  {
    $seguidores = $tabela["seguidores"];
  }
  $seguidores = $seguidores - 1;
  $sqlb = "UPDATE users set seguidores='$seguidores' where id='$idmaior'";
  $query = mysqli_query($conn, $sqlb) or die ("Erro");  
  } 
}

$sql = "delete from login where id='$id'";
$query = mysqli_query($conn, $sql) or die ("");
$sql = "delete from users where id='$id'";
$query = mysqli_query($conn, $sql) or die ("");

$sqla = "select * from posts where user_id='$id'";
$resultado=mysqli_query($conn,$sqla);
while($tabela=mysqli_fetch_array($resultado))
{
  $postid = $tabela["id"];

  $sql = "delete from comments where post_id='$postid'";
  $query = mysqli_query($conn, $sql) or die ("");
  $sql = "delete from likes where post='$postid'";
  $query = mysqli_query($conn, $sql) or die ("");
}

$sql = "delete from posts where user_id='$id'";
$query = mysqli_query($conn, $sql) or die ("");
$sql = "delete from chat where remetente='$id' or destinatario='$id'";
$query = mysqli_query($conn, $sql) or die ("");
$sql = "delete from conexoes where id_usuario='$id'";
$query = mysqli_query($conn, $sql) or die ("");


$id = null;
session_start();
$_SESSION['id'] = $id;
echo "<script> location.href='../index.php'</script>";
}

?>