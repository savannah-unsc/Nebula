<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title> Nebula | Entrar </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
  </head>
  <body>

  </body>
</html>

<?php
include_once("conexao.php");

session_start();
$id = $_SESSION['id'];

$usuario = $_POST['username'];
$bio = base64_encode($_POST['bio']);

function notsp($usuario)
{
    $res = preg_replace('/\s+/', '', $usuario);
    return $res;
}
$notsp = notsp($usuario);

if ($notsp == "") {
  echo "<script> location.href='../meuperfil.php'</script>";
} else {

  function filtro($usuario)
  {
      $res = preg_replace('/[\\\,.;:$-+=*?{}<>\"""]+/', '', $usuario);
      return $res;
  }
  $usuario = filtro($usuario);

  $sql = "UPDATE users set usuario='$usuario', bio='$bio' where id='$id'";
  $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar perfil!");

  if (mysqli_affected_rows($conn)){
  echo "<script> location.href='../meuperfil.php'</script>";
  }
  else{
  echo "<script> location.href='../meuperfil.php'</script>";
  }

}
?>
