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
$query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro 2: Erro ao registrar usuário.') </script> <script> location.href='../chat.php?id=$idconvidado </script>");
if (mysqli_affected_rows($conn)){
echo "<script> location.href='../batepapo.php?id=$idconvidado'</script>";
}
else {
echo "<script> location.href='../batepapo.php?id=$idconvidado'</script>";
}

?>