<?php
ini_set('display_errors', 0);
error_reporting(0);

include ("php/conexao.php");

session_start();
$id = $_SESSION['id'];

if(isset($id) == false){
  echo "<script> location.href='entrar.html'</script>";
}

$sql = "select * from users where id='$id'";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{

$id = $tabela["id"];
$usuario = $tabela["usuario"];
$uid = $tabela["uid"];
$bio = base64_decode($tabela["bio"]);
$banner = $tabela["banner"];
$icon = $tabela["icon"];
$seguindo = $tabela["seguindo"];
$seguidores = $tabela["seguidores"];
}

$bio = htmlspecialchars($bio);
?>

<!DOCTYPE html>
<html lang='pt-br'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title> <?php echo "$usuario"; ?> | Nebula </title>
    <link rel='shortcut icon' href='../nebula.ico' type='image/x-icon'/>
    <link rel='stylesheet' href='../css/profile.css'>
    <link rel='stylesheet' href='../css/estilo.css'>
  </head>
  <body>
    <?php 
    
    $sql = "select * from users where id='$id'";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$icone = $tabela["icon"];
$usuario = $tabela["usuario"];
}
    
    include 'php/navmain.php';
    ?>
    <div id="perfil">
      <?php
      echo "<div id='banner' style='background-image: url(../img/user_banners/$banner);'>
        <div id='icon' style='background-image: url(../img/user_icons/$icon);'>
        ";
        ?>
      </div>
      </div>
      <form action="editarperfil.php">
        <?php
        echo "<h1 id='username'> $usuario<b class='gray'>#$uid</b> </h1>";
        ?>
        <input id="editbtn" type="submit" value="Editar">
        <?php
        echo "<p class='gray' id='bio'> $bio </p>";
        ?>
      </form>
      <div id="seg">
        <div id='seguindo'> <?php echo "<h1> Seguindo </h1> <h2 class='gray'> $seguindo </h2>"; ?> </div>
        <div id='seguido'> <?php echo "<h1> Seguidores </h1> <h2 class='gray'> $seguidores </h2>"; ?> </div>
      </div>
    </div>
    <div id="myposts">
<?php
    $sql = "SELECT * FROM posts where user_id = $id order by id desc";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
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
  $curtidasform = "<form class='curtirf' action='php/curtir.php' method='post'>";
} else {
  $curtidasform = "<form class='curtir' action='php/curtir.php' method='post'>";
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

?>
  <p id="end"> Você chegou ao fim da navegação! </p>
</div>
  </body>
</html>
