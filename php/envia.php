<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
  </head>
  <body>

<?php
  include 'conexao.php';

  session_start();
  $id = $_SESSION['id'];

  $idconvidado = $_POST['destinatario'];
  $msg = base64_encode($_POST['msg']);
  $nodatamsg = $_POST['postmsg'];

if(isset($id) == false){
  echo "<script> location.href='entrar.html'</script>";
}
  $data = date('Y-m-d');
  $hora = date('H');
  $newhora = $hora - 5;
  $min = date('i:s');
  $hora = "$newhora:$min";
  $datahora = "$data $hora";

$sql = "INSERT INTO chat (remetente, destinatario, mensagem, datahora) values ($id, $idconvidado, '$msg', '$datahora')";
$query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro') </script> <script> location.href='../chat.php?id=$idconvidado </script>");

$sqla = "select * from chat where remetente = $id and destinatario = $idconvidado and mensagem = '$msg' and datahora = '$datahora'";
$resultado=mysqli_query($conn,$sqla);
while($table=mysqli_fetch_array($resultado))
{
  $notid = $table["id"];
}

$sql = "INSERT INTO notifications (destinatario, remetente, interacao, tipo) values('$idconvidado', '$id', '$notid', 1);";
$query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro') </script> <script> window.history.back() </script>");

if (mysqli_affected_rows($conn)){
echo "<script> location.href='../conversa.php?id=$idconvidado'</script>";
}
else {
echo "<script> location.href='../conversa.php?id=$idconvidado'</script>";
}

?>