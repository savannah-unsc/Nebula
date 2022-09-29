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
  $nodatamsg = $_POST['msg'];

  function notsp($nodatamsg)
{
    $res = preg_replace('/\s+/', '', $nodatamsg);
    return $res;
}
$notsp = notsp($nodatamsg);

if ($notsp == "") {
  echo "</script> <script> window.close() </script>";
} else {

  if(isset($id) == false){
    echo "</script> <script> window.close() </script>";
  }
    $data = date('Y-m-d');
    $hora = date('H');
    $newhora = $hora - 5;
    $min = date('i:s');
    $hora = "$newhora:$min";
    $datahora = "$data $hora";
  
  $sql = "INSERT INTO chat (remetente, destinatario, mensagem, datahora) values ($id, $idconvidado, '$msg', '$datahora')";
  $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro') </script> <script> window.close() </script>");
  
  $sqla = "select * from chat where remetente = $id and destinatario = $idconvidado and mensagem = '$msg' and datahora = '$datahora'";
  $resultado=mysqli_query($conn,$sqla);
  while($table=mysqli_fetch_array($resultado))
  {
    $notid = $table["id"];
  }
  
  $sql = "INSERT INTO notifications (destinatario, remetente, interacao, tipo) values('$idconvidado', '$id', '$notid', 1);";
  $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro') </script> </script> <script> window.close() </script>");
  
  if (mysqli_affected_rows($conn)){
    echo "<script> window.close() </script>";
  }
  else {
    echo "<script> window.close() </script>";
  }

}

?>