<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/salvos.css">
  </head>
  <body>

<?php
ini_set('display_errors', 0);
error_reporting(0);

include 'php/conexao.php';

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
include 'php/scrtop.php';
?>
<div id="corpo" class="corpo">
</div>
<p id="end"> Você chegou ao fim da navegação! </p>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/spostload.js"></script>
</body>
</html>