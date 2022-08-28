<?php

ini_set('display_errors', 0);
error_reporting(0);

include 'conexao.php';

session_start();
$id = $_SESSION['id'];

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

    if ($curtidas >= 1000) {
      $curtidas = $curtidas / 1000;
      $curtidas = number_format($curtidas, 1, '.', '');
      $curtidas = "$curtidas<b>k</b>";
    }
    
    if ($curtidas >= 1000000) {
      $curtidas = $curtidas / 1000;
      $curtidas = number_format($curtidas, 1, '.', '');
      $curtidas = "$curtidas<b>M</b>";
    }
    
    $sqla = "SELECT * FROM users where id = $publisherid";
    $resultado=mysqli_query($conn,$sqla);
    if ($tabela=mysqli_fetch_array($resultado)) {
      $publishername = $tabela['usuario'];
      $publisheruid = $tabela['uid'];
      $publishericon = $tabela['icon'];
      $publisherbanner = $tabela['banner'];
    }

    $sqlb = "SELECT * from likes where usuario = $id and post = $postid";
    $res=mysqli_query($conn,$sqlb);
    while($table=mysqli_fetch_array($res))
    {
        $curtval = $table["post"];
    }

if ($curtval == $postid) {
  $curtidasform = "<form class='curtirf' action='php/curtir.php' method='post' target='_BLANK'>";
} else {
  $curtidasform = "<form class='curtir' action='php/curtir.php' method='post' target='_BLANK'>";
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
      $curtidasform
      <input type='hidden' name='postid' value='$postid'>
      <input type='submit' value='' class='invbtn'>
      </form>
      <div class='curtidas'> <h2> $curtidas </h2> </div>
      <form class='pubview' action='post.php' method='get'>
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
        $curtidasform
        <input type='hidden' name='postid' value='$postid'>
        <input type='submit' value='' class='invbtn'>
        </form>
        <div class='curtidas'> <h2> $curtidas </h2> </div>
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