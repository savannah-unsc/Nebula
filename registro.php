<?php
ini_set('display_errors', 0);
error_reporting(0);

include('php/conexao.php');

$login = hash('sha256', $_POST['login']);
$password = hash('sha256', $_POST['password']);
$confirm_password = hash('sha256', $_POST['confirm_password']);

$sql = "select * from login where email='$login'";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$cloneemail = $tabela["email"];
}

if ($cloneemail == $login) {
  echo "<script> window.alert('Email já registrado!') </script>";
  echo "<script> window.history.back() </script>";
}

if ($password != $confirm_password) {
  echo "<script> window.alert('Os campos de senha devem ser iguais!') </script>";
  echo "<script> window.history.back() </script>";
}

?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nebula | Registrar-se (Passo 2) </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/cadastro.css">
  </head>
  <body>
    <div id="corpo">
      <div id="logo"></div>
      <form action="php/registro.php" id="corpo_cadastro" method="post">
        <h1 id="wel"> Crie seu Perfil </h1>
        <input type="hidden" name="login" value="<?php echo "$login"; ?>">
        <input type="hidden" name="password" value="<?php echo "$password"; ?>">
        <div class="inpf"> <input type="text" name="username" class="inptxt" placeholder="Nome de Usuário" minlength="4" maxlength="20" required> </div>
        <div class="taf"> <textarea name="bio" class="areatxt" placeholder="Biografia" maxlength="150"> Olá, eu sou novo(a) no Nebula! </textarea> </div>
        <input type="submit" id="cadbtn" value="Registrar">
      </form>
      <form action="entrar.html" method="post"> <input type="submit" id="logbtn" value="Já Registrado?"> </form>
    </div>
    <script src="js/psstotxt.js"></script>
  </body>
</html>
