  <!DOCTYPE html>
  <html lang="pt-br" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/post.css">
  </head>

  <body>

<?php
    // ini_set('display_errors', 0);
    // error_reporting(0);

include 'php/conexao.php';
include 'php/mostralink.php';

    session_start();
    $id = $_SESSION['id'];

$postid = $_GET['publicacao'];

$sql = "SELECT * FROM posts where id = $postid";

$result = mysqli_query($conn, $sql);
while ($tabela = mysqli_fetch_array($result)) {
  $postid = $tabela['id'];
  $publisherid = $tabela['user_id'];
  $tipo = $tabela['tipo'];
  $midia = $tabela['midia'];
  $curtidas = $tabela['curtidas'];
  $msg = base64_decode($tabela['conteudo']);
  $msg = htmlspecialchars($msg);
  $msg = MontarLink($msg);

  $sqla = "SELECT * FROM users where id = $publisherid";
  $resultado = mysqli_query($conn, $sqla);
  if ($tabela = mysqli_fetch_array($resultado)) {
    $publishername = $tabela['usuario'];
    $publisheruid = $tabela['uid'];
    $publishericon = $tabela['icon'];
    $publisherbanner = $tabela['banner'];
  }
}

if (isset($msg) == false) {
  echo "<script> location.href='principal.php'</script>";
}

?>

  <div id="postmenubg" onclick="menupost()">
    <form id="postmenu" action="php/salvarpost.php" method="post">
      <?php

$sql = "SELECT * from salvos where user_id = $id and post_id = $postid";
$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$validade = $tabela["id"];
}

if (isset($validade) == true) {
  echo("<input class='pmbtn' type='submit' value='Remover dos Salvos'>");
} else {
  echo("<input class='pmbtn' type='submit' value='Salvar Postagem'>");
}

      echo("<input type='hidden' value='$postid' name='postarsalvar'>");
      if ($tipo == 1) {
        echo("<a href='posts/$midia' download> Salvar Imagem </a>"); 
      } ?>
      <button class="pmbtn" type="button"> Fechar </button>
      </form>
  </div>

    <?php

    $sql = "select * from users where id='$id'";

    $result = mysqli_query($conn, $sql);
    while ($tabela = mysqli_fetch_array($result)) {
      $icone = $tabela["icon"];
    }

    if (isset($id) == false) {
      include 'php/navnologin.php';
    } else {
      include 'php/navmain.php';
    }
    ?>
    <form action="php/comentar.php" id="comentbar" method="post">
      <input type="text" name="mensagem" id="comentartxt" placeholder="O que você tem a dizer?" maxlength="150" required>
      <input type="hidden" name="postid" value="<?php echo ("$postid"); ?>">
      <input type="submit" value="Comentar" id="comentarbtn">
    </form>
    <div id="gbr"></div>

    <div id="corpo" onclick="menupost();">
      <div id="profinfo">
        <?php echo ("<form id='pubico' action='perfil.php' style='background-image: url(img/user_icons/$publishericon)'>
        <input type='hidden' value='$publisherid' name='id'>
        <input type='submit' value='' id='invbtn'> </form>
        <h1 id='pubname'>$publishername<b class='gray'>#$publisheruid</b> </h1>"); ?>
      </div>
      <div id="imagecont">
        <?php 
        if ($tipo == 1) {
          echo ("<div>
          <img id='pubimg' src='posts/$midia'>
          </div>");
        } ?>
      </div>
      <div id="pubtxt">
        <?php echo ("<p id='msg'> $msg </p>"); ?>
      </div>
      <div id="commentscont">
        <?php
          $sql = "SELECT * FROM comments where post_id = $postid order by id desc";

          $result = mysqli_query($conn, $sql);
        while ($tabela = mysqli_fetch_array($result)) {
          $userid = $tabela['user_id'];
          $msg = base64_decode($tabela['msg']);

          $sqla = "SELECT * FROM users where id = $userid";

          $resultado = mysqli_query($conn, $sqla);
            while ($tabela = mysqli_fetch_array($resultado)) {
              $conuser = $tabela['usuario'];
              $conuid = $tabela['uid'];
              $conicon = $tabela['icon'];

            echo ("<div class='comentario'>
            <div class='headconmsg'>
            <form style='background-image: url(img/user_icons/$conicon)' class='conico' action='perfil.php'>
            <input type='hidden' name='id' value='$userid'>
            <input type='submit' value='' id='invbtn'>
            </form>
            <div>
            <h1 class='headconus'> $conuser<b class='gray'>#$conuid</b></h1>
            </div>
            </div>
            <p class='conmsg'> $msg </p>
            </div>");
          }}

        ?>
      </div>
    </div>

    <script src="js/menus"></script>
  </body>
  </html>