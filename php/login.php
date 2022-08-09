<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title> Nebula | Entrar </title>
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

session_start();
$_SESSION['id'] = $id;
}

if (mysqli_affected_rows($conn)){
echo "<script> location.href='../home.php'</script>";
}
else{
echo "<script> window.alert('Email ou Senha incorretos!') </script>";
echo "<script> window.history.back() </script>";
}

?>
