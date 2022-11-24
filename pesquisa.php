<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/pesquisa.css">
  </head>
  <body>

<?php
ini_set('display_errors', 0);
error_reporting(0);

include 'php/conexao.php';

session_start();
$id = $_SESSION['id'];
$busca = $_GET['busca'];
$busca2 = $_GET['busca'];

$sql = "select * from users where id='$id'";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$icone = $tabela["icon"];
}

function notsp($busca2)
{
    $res = preg_replace('/\s+/', '', $busca2);
    return $res;
}
$notsp = notsp($busca2);

if ($notsp == "") {
  echo "<script> location.href='../principal.php'</script>";
}

if(isset($busca) == false){
	include 'principal.php';
}

if(isset($id) == false){
	include 'php/navnologin.php';
} else {
  include 'php/navmain.php';
}

include 'php/scrtop.php';

echo "<div id='corpo'>";

if ($busca == "*") {
    $sql = "select * from users";
} else {
    $sql = "select * from users where usuario like '%$busca%' order by seguidores desc";
}

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$idconvidado = $tabela["id"];
$usuario = $tabela["usuario"];
$uid = $tabela["uid"];
$icon = $tabela["icon"];
$banner = $tabela["banner"];

if ($idconvidado != $id) {
  echo "<form action='perfil.php' class='profile' method='get'>
  <div class='banner' style='background-image: url(img/user_banners/$banner)'>
  <div class='usericon' style='background-image: url(img/user_icons/$icon)'>
  <input type='submit' value='' id='invbtn'>
  </div>
  </div>
  <input type='hidden' name='id' value='$idconvidado'>
  <button class='profbtn' type='submit'>
  <h1> $usuario<b class='gray'>#$uid</b> </h1>
  </button>
  </form>";
}
}


?>
</div>
</body>
</html>
