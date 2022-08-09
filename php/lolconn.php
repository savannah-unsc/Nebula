<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
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
$lolname = base64_encode($_POST['loname']);

$sql = "select * from conexoes where id_usuario=$id and tipo='leaguel'";
$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$validade = $tabela["id"];
}

if (isset($validade) == true) {
  
$sql = "UPDATE conexoes set valor='$lolname' where id_usuario='$id' and tipo='leaguel'";
$query = mysqli_query($conn, $sql) or die ("Erro ao atualizar banner!");

if (mysqli_affected_rows($conn)){
  echo "<script> location.href='../config.php'</script>";
}
else{
  echo "<script> location.href='../config.php'</script>";
}

} else {
  
$sql = "INSERT INTO conexoes (id_usuario, tipo, valor) values('$id', 'leaguel', '$lolname')";
$query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro 2: Erro ao registrar usuário.') </script> <script> window.history.back() </script>");
if (mysqli_affected_rows($conn)){
echo "<script> location.href='../config.php'</script>";
}
else {
echo "<script> location.href='../config.php'</script>";
}

}

?>
