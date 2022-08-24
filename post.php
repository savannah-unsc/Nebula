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

    session_start();
    $id = $_SESSION['id'];

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

      $sqla = "SELECT * FROM users where id = $publisherid";
      $resultado = mysqli_query($conn, $sqla);
      if ($tabela = mysqli_fetch_array($resultado)) {
        $publishername = $tabela['usuario'];
        $publisheruid = $tabela['uid'];
        $publishericon = $tabela['icon'];
        $publisherbanner = $tabela['banner'];
      }
    }
    ?>
    <form action="php/comentar.php" id="comentbar" method="post">
      <input type="text" name="mensagem" id="comentartxt" placeholder="O que você tem a dizer?" maxlength="150">
      <input type="hidden" name="postid" value="<?php echo ("$postid"); ?>">
      <input type="submit" value="Comentar" id="comentarbtn">
    </form>

    <div id="corpo">
      <div id="profinfo">
        <?php echo("<form id='pubico' action='perfil.php' style='background-image: url(img/user_icons/$publishericon)'>
        <input type='hidden' value='$publisherid' name='id'>
        <input type='submit' value='' id='invbtn'> </form>
        <h1 id='pubname'>$publishername<b class='gray'>#$publisheruid</b> </h1>"); ?>
      </div>
      <div id="imagecont" style="background-image: url("<?php echo("posts/$midia");?>");">
      </div>
      <div id="pubtxt">
        <?php echo("<p id='msg'> $msg </p>"); ?>
      </div>
      <div id="commentscont">

      </div>
    </div>

  </body>

  </html>