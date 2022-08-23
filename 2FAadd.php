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
$id = $_SESSION['id'];

if(isset($id) == false){
	echo "<script> location.href='entrar.html'</script>";
}

$sql = "select * from login where id = $id";
$query = mysqli_query($conn, $sql) or die ("Erro!");

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$v2FA = $tabela["validade_2FA"];
$c2FA = $tabela["codigo_2FA"];
}

$sql = "select * from users where id = $id";
$query = mysqli_query($conn, $sql) or die ("Erro!");

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$user = $tabela["usuario"];
$uid = $tabela["uid"];
}

if ($v2FA == 0 and $c2FA == "") {
        $secret = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUV"), 0, 16);
        
        $sql = "UPDATE login set codigo_2FA = '$secret' where id = $id";
        $query = mysqli_query($conn, $sql) or die ("Erro");

        $c2FA = $secret;
}

$_SESSION['auth_secret'] = $c2FA;

$Authenticator = new Authenticator();

$qrCodeUrl = $Authenticator->getQR("Nebula (".$user."".$uid.")", $c2FA);

?>

<form id="corpo" action="php/check.php" method="post">
<div id="title"> <h1> Autenticação de 2 Fatores </h1> </div>
<div id="code" style="background-image: url(<?php echo("$qrCodeUrl")?>)"> </div>
<input type="text" placeholder="Codigo" name="code" id="codeinp" minlength="6" maxlength="6" required>
<input type="submit" value="<?php

if ($v2FA == 0) {
  echo("Ativar");
} else {
  echo("Desativar");
}

?>" id="codebtn">
</form>

</body>
</html>