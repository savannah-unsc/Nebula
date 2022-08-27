<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="../nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../css/estilo.css">
  </head>
  <body>
  </body>
</html>

<?php
include_once("conexao.php");

session_start();
$id = $_SESSION['id'];
$msg = base64_encode($_POST['mensagem']);
$postid = $_POST['postid'];
$nodatamsg = $_POST['mensagem'];

function notsp($nodatamsg)
{
    $res = preg_replace('/\s+/', '', $nodatamsg);
    return $res;
}
$notsp = notsp($nodatamsg);

if ($notsp == "") {
  echo "<script> location.href='../post.php?publicacao=$postid'</script>";
} else {
  $sql = "INSERT INTO comments (user_id, post_id, msg) values('$id', '$postid', '$msg');";
  $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro') </script> <script> window.history.back() </script>");
  
  $sqla = "select * from posts where id = $postid";
  $resultado=mysqli_query($conn,$sqla);
  while($table=mysqli_fetch_array($resultado))
  {
    $dest = $table["user_id"];
  }

  $sql = "select * from comments where user_id = $id and post_id = $postid and msg = '$msg'";
  $result=mysqli_query($conn,$sql);
  while($tabela=mysqli_fetch_array($result))
  {
    $inter = $tabela["id"];
  }

  $sql = "INSERT INTO notifications (destinatario, remetente, interacao, tipo) values('$dest', '$id', '$inter', 0);";
  $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro') </script> <script> window.history.back() </script>");

  if (mysqli_affected_rows($conn)){
  echo "<script> location.href='../post.php?publicacao=$postid'</script>";
  }
  else {
  echo "<script> location.href='../post.php?publicacao=$postid'</script>";
  }
}

?>
