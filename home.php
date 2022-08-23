<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/home.css">
  </head>
  <body>

<?php
// ini_set('display_errors', 0);
// error_reporting(0);

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
<div id="body">
  <div></div>
  <div id="corpo_principal">

<form id="postarform" action="php/postar.php" enctype="multipart/form-data" method="post">
<textarea name="postmsg" id="postararea" placeholder="Diga o que está acontecendo, <?php echo $usuario;?>!" maxlength="512" required></textarea>
<div id="postimagepreview" style=""></div>
<label id="postarlab" for="postarfile"> </label>
<input id="postarfile" type="file" name="postmedia" accept="image/*">
<input id="postarbtn" type="submit" value="Publicar">
</form>

<?php

$postagens = "user_id = $id ";

$sql = "select * from follow where idmaior ='$id' or idmenor ='$id'";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$idmaior = $tabela["idmaior"];
$idmenor = $tabela["idmenor"];
$maiormenor = $tabela["maiormenor"];
$menormaior = $tabela["menormaior"];
if ($idmaior != $id) {
  if ($menormaior == 1) {
    $postagens = "$postagens or user_id = $idmaior ";
  }
}
if ($idmenor != $id) {
  if ($maiormenor == 1) {
    $postagens = "$postagens or user_id = $idmenor ";
  }
}
}

if ($postagens == "user_id = $id ") { 
$sql = "select * from users where id != $id";
$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
  $idoutro = $tabela["id"];
  $postagens = "$postagens or user_id = $idoutro";
}
}

$sql = "SELECT * FROM posts where $postagens order by id desc";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
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
  <form class='foto' action='post.php' target='_blank' method='get'>
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
  <form class='pubview' action='post.php' target='_blank' method='get'>
  <input type='hidden' name='publicacao' value='$postid'>
  <input type='submit' value='Comentários' class='postvbtn'>
  </form>
  </div>
  </div>";

}
}

?>

<p id="end"> Você chegou ao fim da navegação! </p>
</div>
  <div></div>
  </div>
<script type="text/javascript" src="js/imgprev.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
</body>
</html>
