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
?>
<div id="corpo">

<?php

$sql = "SELECT * FROM salvos where user_id = '$id' order by id desc";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
    $post_id = $tabela["post_id"];
    
$sqla = "SELECT * FROM posts where id = '$post_id'";

$resultado=mysqli_query($conn,$sqla);
while($tabela=mysqli_fetch_array($resultado))
{
    $postid = $tabela['id'];
    $publisherid = $tabela['user_id'];
    $tipo = $tabela['tipo'];
    $midia = $tabela['midia'];
    $curtidas = $tabela['curtidas'];
    $msg = base64_decode($tabela['conteudo']);
    
    $sqla = "SELECT * FROM users where id = $publisherid";
    $resultado=mysqli_query($conn,$sqla);
    if ($tabela=mysqli_fetch_array($resultado)) {
      $publishername = $tabela['usuario'];
      $publisheruid = $tabela['uid'];
      $publishericon = $tabela['icon'];
      $publisherbanner = $tabela['banner'];
    }
    
    $msg = htmlspecialchars($msg);

    if ($tipo == 0) {

        echo "<div id='postagem'>
        <div id='postheader'>
        <form action='perfil.php' class='icon' method='get' style='background-image: url(img/user_icons/$publishericon)'>
        <input type='hidden' name='id' value='$publisherid'>
        <input type='submit' value='' class='invico'>
        </form>
        <h1 class='pubname'> $publishername<b class='gray'>#$publisheruid</b></h1>
        </div>
        <div>
        <p class='pubtxt'> $msg </p>
        </div>
        <div class='acoes'>
        <div></div>
        <form class='curtir'> </form>
        <div class='curtidas'> <h2> $curtidas </h2> </div>
        <form class='compartilhar'> </form>
        <form class='pubview' action='post.php' target='_blank' method='get'>
        <input type='hidden' name='publicacao' value='$postid'>
        <input type='submit' value='Comentários' class='postvbtn'>
        </form>
        </div>
        </div>";
        
        } else {
        
          echo "<div id='postagem'>
          <div id='postheader'>
          <form action='perfil.php' class='icon' method='get' style='background-image: url(img/user_icons/$publishericon)'>
          <input type='hidden' name='id' value='$publisherid'>
          <input type='submit' value='' class='invico'>
          </form>
          <h1 class='pubname'> $publishername<b class='gray'>#$publisheruid</b></h1>
          </div>
          <div>
          <p class='pubtxt'> $msg </p>
          <form class='foto' action='post.php' method='get'>
          <input type='hidden' name='publicacao' value='$postid'>
          <button type='submit' class='imabot'>
          <img src='posts/$midia' class='imageviewer'>
          </button>
          </form>
          </div>
          <div class='acoes'>
          <div></div>
          <form class='curtir'> </form>
          <div class='curtidas'> <h2> $curtidas </h2> </div>
          <form class='compartilhar'> </form>
          <form class='pubview' action='post.php' method='get'>
          <input type='hidden' name='publicacao' value='$postid'>
          <input type='submit' value='Comentários' class='postvbtn'>
          </form>
          </div>
          </div>";
 
}
}
}
?>

</div>
<p id="end"> Você chegou ao fim da navegação! </p>
</body>
</html>