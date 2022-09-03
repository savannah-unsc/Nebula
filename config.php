<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
  <meta charset="utf-8">
  <title> Nebula </title>
  <link rel="shortcut icon" href="nebula.ico" type="image/x-icon" />
  <link rel="stylesheet" href="css/estilo.css">
  <link rel="stylesheet" href="css/config.css">
</head>

<body>

  <div id="combgdiv">
    <button id="closebtn" onclick="menucom()"> x </button>
    <form id="comchdiv" action="php/comtrans.php" method="post">
      <div>
        <input class="cbcom" name="cbcom" type="checkbox" required>
        <label class="cbcom" for="cbcom"> Confirmo que desejo transformar meu perfil em uma comunidade (Essa ação é irreversivel) </label>
      </div>
      <input type="submit" value="Guardar" id="comcbbtn">
    </form>
  </div>

  <?php
  include 'php/conexao.php';
  session_start();
  $id = $_SESSION['id'];

  if (isset($id) == false) {
    echo "<script> location.href='entrar.html'</script>";
  }

  $sql = "select * from users where id='$id'";

  $result = mysqli_query($conn, $sql);
  while ($tabela = mysqli_fetch_array($result)) {
    $icone = $tabela["icon"];
    $usuario = $tabela["usuario"];
    $tipo = $tabela["tipo"];
  }

  include 'php/navmain.php';
  ?>

  <h1 class="headerh1"> Conexões </h1>

  <form class="confmenu" action="php/lolconn.php" method="post">
    <div class="titlemenu">
      <h1 class="title"> League of Legends </h1>
    </div>
    <div class="conmenu">
      <input type="text" id="lolinp" name="loname" placeholder="Nome de Invocador" minlength="3" maxlength="16" required>
    </div>
    <div class="confirmbtndiv">
      <input class="confirmbtn" type="submit" value="Guardar">
    </div>
  </form>

  <!-- <div class="confmenu">
    <div class="titlemenu"> <h1 class="title"> Spotify </h1> </div>
    <div class="conmenu">
      <div class="inpf"> <input type="password" name="password" class="inptxt" id="password" placeholder="Senha" minlength="8" maxlength="32" required> </div>
      <div class="inp"> <input type="password" name="password" class="inptxt" id="password" placeholder="Senha" minlength="8" maxlength="32" required> <button type="button" id="vbtn" onclick="altpas()"> <img class="visibility" src="img/icons/visibility.png"> </button> </div>
    </div>
    <div class="confirmbtndiv">
      <input class="confirmbtn" type="submit" value="Guardar">
    </div>
  </div> -->

  <h1 class="headerh1"> Minha Conta </h1>

  <form class="confmenu2" action="php/emailatt.php" method="post">
    <div class="titlemenu">
      <h1 class="title3"> Alterar Email ou Senha </h1>
    </div>
    <div class="conmenu">
      <div class="inpf"> <input type="email" name="loginold" class="inptxt" placeholder="Email Antigo" maxlength="60" required> </div>
      <div class="inp"> <input type="password" name="passwordold" class="inptxt" id="password" placeholder="Senha Antiga" minlength="8" maxlength="32" required> <button type="button" id="vbtn" onclick="altpas()"> <img class="visibility" src="img/icons/visibility.png"> </button> </div>
      <div class="inpf"> <input type="email" name="loginnew" class="inptxt" placeholder="Email Novo" maxlength="60" required> </div>
      <div class="inp"> <input type="password" name="passwordnew" class="inptxt" id="password2" placeholder="Senha Nova" minlength="8" maxlength="32" required> <button type="button" id="vbtn" onclick="altpas()"> <img class="visibility" src="img/icons/visibility.png"> </button> </div>
    </div>
    <div class="confirmbtndiv">
      <input class="confirmbtn" type="submit" value="Guardar">
    </div>
  </form>

  <form class="confmenu" action="2FAadd.php">
    <div class="titlemenu">
      <h1 class="title2l"> Ativar verificação de 2 fatores </h1>
    </div>
    <div class="conmenu">
      <h1 class="title">
        <?php

        $sql = "select * from login where id = $id";
        $query = mysqli_query($conn, $sql) or die("Erro!");

        $result = mysqli_query($conn, $sql);
        while ($tabela = mysqli_fetch_array($result)) {
          $v2FA = $tabela["validade_2FA"];
        }

        if ($v2FA == 0) {
          echo ("Desativada");
        } else {
          echo ("Ativada");
        }

        ?>
      </h1>
    </div>
    <div class="confirmbtndiv">
      <input class="confirmbtn" type="submit" value="
      <?php
      if ($v2FA == 0) {
        echo ("Ativar");
      } else {
        echo ("Desativar");
      }
      ?>
     ">
    </div>
  </form>

  <div class="confmenu">
    <div class="titlemenu">
      <h1 class="title"> Ativar Comunidade </h1>
    </div>
    <div class="conmenu">
      <h1 class="title">
        <?php

        if ($tipo == 0) {
          echo "Perfil Comum";
        } else {
          echo "Comunidade";
        }

        ?>
      </h1>
    </div>
    <div class="confirmbtndiv">
      <?php
      if ($tipo == 0) {
        echo "<button class='confirmbtn' id='combtn' type='button' onclick='menucom()'>
        Ativar
        </button>";
      } else {
        echo "<button class='confirmbtn' id='combtn' type='button'>
        Ativa
        </button>";
      }
      ?>
    </div>
  </div>

  <form class="confmenu" action="php/delete4ever.php" method="post">
    <div class="titlemenu">
      <h1 class="title"> Apagar Conta </h1>
    </div>
    <div class="conmenu">
      <div class="inpf"> <input type="email" name="login" class="inptxt" placeholder="Email" maxlength="60" required> </div>
      <div class="inp"> <input type="password" name="password" class="inptxt" id="password3" placeholder="Senha" minlength="8" maxlength="32" required> <button type="button" id="vbtn" onclick="altpas()"> <img class="visibility" src="img/icons/visibility.png"> </button> </div>
    </div>
    <div class="confirmbtndiv">
      <input class="confirmbtn" type="submit" value="Confirmar">
    </div>
  </form>

  <form id="exitform" action="php/exit.php" method="post">
    <input id="exitbtn" type="submit" value="Sair">
  </form>

  <script src="js/menus.js"></script>
  <script src="js/psstotxt.js"></script>
</body>

</html>