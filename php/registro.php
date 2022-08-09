<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title> Nebula | Registrar-se (Passo 3) </title>
    <link rel="shortcut icon" href="../nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../css/estilo.css">
  </head>
  <body>
  </body>
</html>

<?php
include_once("conexao.php");

$email = $_POST['login'];
$senha = $_POST['password'];

$usuario = $_POST['username'];
$bio = base64_encode($_POST['bio']);
$uid = rand(1000, 9999);

function filtro($usuario)
{
    $res = preg_replace('/[\\\,.;:$-+=*?{}<>\"""]+/', '', $usuario);
    return $res;
}
$usuario = filtro($usuario);

$sql = "INSERT INTO login (email, senha) values('$email', '$senha')";
$query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro 1: Erro ao registrar email e senha.') </script> <script> window.history.back() </script>");
if (mysqli_affected_rows($conn)){

$sql = "SELECT * from login where email='$email'";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$id = $tabela["id"];
}

$sql = "INSERT INTO users (id, usuario, uid, bio) values('$id', '$usuario', '$uid', '$bio')";
$query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro 2: Erro ao registrar usuário.') </script> <script> window.history.back() </script>");
if (mysqli_affected_rows($conn)){
echo "<script> location.href='../entrar.html'</script>";
}
else {
echo "<script> window.alert('Erro 2: Erro ao resgistrar usuário.') </script>";
echo "<script> window.history.back() </script>";
}

}
else{
echo "<script> window.alert('Erro 1: Erro ao registrar email e senha.') </script>";
echo "<script> window.history.back() </script>";
}

?>
