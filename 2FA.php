<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="../nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/2FA.css">
  </head>
  <body>

<?php
include ("php/conexao.php");
require "php/Authenticator.php";

session_start();
$email = $_SESSION['email'];
$senha = $_SESSION['senha'];

$sql = "select * from login where email = '$email' and senha = '$senha'";
$query = mysqli_query($conn, $sql) or die ("Erro!");

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$v2FA = $tabela["validade_2FA"];
$c2FA = $tabela["codigo_2FA"];
}

if ($v2FA == 0 and $c2FA == "") {
  echo "<script> location.href='../entrar.html'</script>";
}

$_SESSION['auth_secret'] = $c2FA;

?>

<form id="corpo2" action="php/check2.php" method="post">
<div id="title"> <h1> Entrar </h1> </div>
<input type="text" placeholder="Codigo" name="code" id="codeinp" minlength="6" maxlength="6" required>
<input type="submit" value="Entrar" id="codebtn">
</form>

</body>
</html>