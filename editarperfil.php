<?php
include ("php/conexao.php");

session_start();
$id = $_SESSION['id'];

if (isset($id) == false) {
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

?>

<!DOCTYPE html>
<html lang='pt-br'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title> <?php echo "$usuario"; ?> | Nebula </title>
    <link rel='shortcut icon' href='../nebula.ico' type='image/x-icon'/>
    <link rel='stylesheet' href='../css/eprofile.css'>
    <link rel='stylesheet' href='../css/estilo.css'>
  </head>
  <body>
    <?php include 'php/navmain.php';?>
    <div id="perfil">
      <?php

      echo "<div id='banner' style='background-image: url(img/user_banners/$banner'>
        <div id='icon' style='background-image: url(img/user_icons/$icon);'>
        </div>
        </div>";
        ?>
      <div id="icoban">
        <form class="icobanform" action="php/upico.php" enctype="multipart/form-data" method="post">
          <div class="icobanlabdiv">
            <label for="upico" class="icobanlab"> Selecionar Ícone </label>
            <input type="file" name="icon" id="upico" class="icobaninp" accept="image/*" required>
          </div>
          <input class="icobanbtn" type="submit" value="Guardar">
        </form>
        <form class="icobanform" action="php/upban.php" enctype="multipart/form-data" method="post">
          <div class="icobanlabdiv">
            <label for="upban" class="icobanlab"> Selecionar Banner </label>
            <input type="file" name="banner" id="upban" class="icobaninp" accept="image/*" required>
          </div>
          <input class="icobanbtn" type="submit" value="Guardar">
        </form>
      </div>
      <form action="php/attnomebio.php" method="post">
        <?php

        echo "<div class='inp'> <input type='text' value='$usuario' name='username' class='inptxt' placeholder='Nome de Usuário' minlength='4' maxlength='20' required> <div> <h1><b class='gray'>#$uid</b></h1> </div> </div>";
        echo "<div id='biodiv'> <textarea placeholder='Biografia' id='bioarea' name='bio' maxlength='150'> $bio </textarea> </div>";
        ?>
        <input id="editbtn" type="submit" value="Salvar">
      </form>
    </div>
    <script type="text/javascript" src="js/imgprev.js"></script>
  </body>
</html>
