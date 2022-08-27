<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nebula </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/contatos.css">
</head>
<body>
<?php
include 'php/conexao.php';

ini_set('display_errors', 0);
error_reporting(0);

session_start();
$id = $_SESSION['id'];

if(isset($id) == false){
	echo "<script> location.href='entrar.html'</script>";
}

$sql = "select * from users where id='$id'";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$icone = $tabela["icon"];
$usuario = $tabela["usuario"];
}

include 'php/navmain.php';
?>
<div id="corpo">
<?php

$sql = "select * from follow where idmaior = $id and maiormenor = 1 and menormaior = 1 or idmenor = $id and maiormenor = 1 and menormaior = 1";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$idmaior = $tabela["idmaior"];
$idmenor = $tabela["idmenor"];

if ($idmaior == $id) {
    $idconvidado = $idmenor;
} else {
    $idconvidado = $idmaior;
}

$sqla = "select * from users where id = $idconvidado";

$resultado=mysqli_query($conn,$sqla);
while($tabela=mysqli_fetch_array($resultado))
{
$convuser = $tabela["usuario"];
$convuid = $tabela["uid"];
$convicon = $tabela["icon"];
$convban = $tabela["banner"];

echo("<form class='contato' action='conversa.php'>
<input type='hidden' value='$idconvidado' name='id'>
<div style='background-image: url(img/user_banners/$convban)' class='convban'>
<div style='background-image: url(img/user_icons/$convicon)' class='convico'>
<input type='submit' value='' class='invbtn'>
</div>
</div>
<button type='submit' class='chatbtn'> <h1>$convuser<b class='gray'>#$convuid</b></h1> </button>
</form>");

}
}

?>
</div>

</body>
</html>