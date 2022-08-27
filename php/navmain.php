<style>
  #space{
    height: 10vh;
  }
  #navbar {
    height: 10vh;
    width: 100vw;
    display: grid;
    grid-template-columns: 20vw 72.5vw 7.5vw;
    position: fixed;
    top: 0;
    background-color: #111214AA;
  }

  #logo {
    background-image: url(../img/logos/white.png);
    background-size: 15vw;
    background-position: center;
    background-repeat: no-repeat;
    transition: 0.3s;
  }

  #logo:hover {
    background-image: url(../img/logos/gray.png);
  }

  #logobtn {
    margin-top: 1vh;
    margin-left: 1vw;
    height: 8vh;
    width: 18vw;
    background-color: #0000;
    border: hidden;
  }

  #buscainp {
    display: grid;
    grid-template-columns: 10vw 30vw 10vw 20vw;
    grid-template-rows: 2.5vh 5vh 2.5vh;
  }

  #inp {
    grid-column-start: 2;
    grid-column-end: 3;
    grid-row-start: 2;
    grid-row-end: 3;
    background-color: #40444B;
    border: hidden;
    border-radius: 0.5vh 0vh 0vh 0.5vh;
  }

  #buscabtn {
    grid-column-start: 3;
    grid-column-end: 4;
    grid-row-start: 2;
    grid-row-end: 3;
    background-color: #2F3136;
    border: hidden;
    border-radius: 0vh 0.5vh 0.5vh 0vh;
    transition: 0.3s;
  }

  #buscabtn:hover {
    background-color: #40444B;
  }

  #chat {
    background-image: url(../img/icons/contatos.png);
    background-size: 2.5vw;
    background-position: center;
    background-repeat: no-repeat;
    transition: 0.3s;
    display: grid;
  }

  #chat:hover {
    background-image: url(../img/icons/contatos_hover.png);
  }

  #config {
    background-image: url(../img/icons/config.png);
    background-size: 2.5vw;
    background-position: center;
    background-repeat: no-repeat;
    transition: 0.3s;
    display: grid;
  }

  #config:hover {
    background-image: url(../img/icons/config_hover.png);
  }

  #navicodiv {
    display: grid;
    grid-template-columns: 0.5vw 4vw 0.5vw;
    grid-auto-rows: 0.5vw 4vw 0.5vw;
    margin-left: auto;
    margin-right: auto;
  }

  #navico {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    grid-row-start: 2;
    grid-row-end: 3;
    grid-column-start: 2;
    grid-column-end: 3;
    border-radius: 100%;
    border: 0.4vh solid #2F3136;
    transition: 0.3s;
    display: grid;
  }

  #navico:hover {
    border: 0.4vh solid #40444B;
  }

  .navbtn {
    background-color: #0000;
    border: hidden;
  }

  #lista {
    margin-left: 78.5vw;
    height: 40vh;
    width: 20vw;
    border-radius: 0.5vh;
    padding-top: 1.5vh;
    padding-bottom: 1.5vh;
    background-color: #202225;
    position: fixed;
    display: grid;
    box-shadow: -5px 5px 5px #0005;
    visibility: hidden;
    transition: 0.3s;
    transform: translateY(-100vh);
  }

  #lista.active {
    visibility: visible;
    transform: translateY(0vh);
  }

  #lista a {

    font-size: 2vh;
    margin-top: 0.5vh;
    margin-bottom: 0.5vh;
    margin-left: 2.5vh;
    color: #FFF;
    text-decoration: none;
    transition: 0.3s;
  }

  #lista a:hover {
    color: #afafaf;
  }

  @media screen and (min-device-width: 430px) and (max-device-width: 1024px) {

    #space{
    height: 20vh;
  }

    #navbar {
      height: 20vh;
      grid-template-columns: 40vw auto 10vw 10vw 15vw;
      grid-template-rows: 10vh 10vh;
    }

    #logo {
      background-size: 35vw;
    }

    #logobtn {
      width: 38vw;
      background-color: #0000;
    }

    #pesquisa {
      grid-column-start: 1;
      grid-column-end: 6;
      grid-row-start: 2;
      grid-row-end: 3;
    }

    #buscainp {
      grid-template-columns: 15vw 50vw 20vw 15vw;
      grid-template-rows: 2.5vh 5vh 2.5vh;
    }

    #chat {
      grid-column-start: 3;
      grid-column-end: 4;
      background-size: 5vw;
    }

    #config {
      grid-column-start: 4;
      grid-column-end: 5;
      background-size: 5vw;
    }

    #navicodiv {
      grid-column-start: 5;
      grid-column-end: 6;
      display: grid;
      grid-template-columns: 1fr 7.5vh 1fr;
      grid-template-rows: 1vh 7.5vh 1vh;
      margin-left: auto;
      margin-right: auto;
    }

    #navico {
      border: 0.5vh solid #2F3136;
    }

    #lista {
      margin-left: 47vw;
      height: 40vh;
      width: 50vw;
      padding-top: 1.5vh;
      padding-bottom: 1.5vh;
    }

  }

@media screen and (max-device-width: 429px) {

    #space{
    height: 20vh;
  }

    #navbar {
      height: 20vh;
      grid-template-columns: 40vw auto 10vw 10vw 20vw;
      grid-template-rows: 10vh 10vh;
    }

    #logo {
      background-size: 35vw;
    }

    #logobtn {
      width: 38vw;
      background-color: #0000;
    }

    #pesquisa {
      grid-column-start: 1;
      grid-column-end: 6;
      grid-row-start: 2;
      grid-row-end: 3;
    }

    #buscainp {
      grid-template-columns: 5vw 65vw 25vw 5vw;
      grid-template-rows: 2.5vh 5vh 2.5vh;
    }

    #chat {
      grid-column-start: 3;
      grid-column-end: 4;
      background-size: 5vw;
    }

    #config {
      grid-column-start: 4;
      grid-column-end: 5;
      background-size: 5vw;
    }

    #navicodiv {
      grid-column-start: 5;
      grid-column-end: 6;
      display: grid;
      grid-template-columns: 1fr 7.5vh 1fr;
      grid-template-rows: 1vh 7.5vh 1vh;
      margin-left: auto;
      margin-right: auto;
    }

    #navico {
      border: 0.5vh solid #2F3136;
    }

    #lista {
      margin-left: 5vw;
      height: 40vh;
      width: 90vw;
      padding-top: 1.5vh;
      padding-bottom: 1.5vh;
    }

  }
</style>
<div id="space"></div>
<div id="navbar">
  <form id="logo" action="principal.php" method="post"><input id="logobtn" type="submit" value=""></form>
  <form action="pesquisa.php" method="get" id="pesquisa">
    <div id="buscainp"> <input id="inp" type="text" name="busca" required> <input id="buscabtn" type="submit" value="Buscar"> </div>
  </form>
  <div id="navicodiv"> <?php echo "<div id='navico' onClick='openmenu();' style='background-image: url(img/user_icons/$icone);'> </div>"; ?> </div>
</div>
<div id="lista">
  <a href="../principal.php"> Página Inicial </a> <br>
  <a href="../meuperfil.php"> Meu Perfil </a> <br>
  <a href="../contatos.php"> Bate Papo </a> <br>
  <a href="../salvos.php"> Itens Salvos </a> <br>
  <a href="../notif.php"> Notificações </a> <br>
  <a href="../config.php"> Configurações </a> <br>
  <a href="../php/exit.php"> Sair </a>
</div>

<script src="../js/menus.js">
</script>