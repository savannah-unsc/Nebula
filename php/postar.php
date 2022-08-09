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
$postmsg = base64_encode($_POST['postmsg']);
$nodatamsg = $_POST['postmsg'];
$media = $_FILES['postmedia'];
$mediaex = pathinfo($media['name'], PATHINFO_EXTENSION);

function notsp($nodatamsg)
{
    $res = preg_replace('/\s+/', '', $nodatamsg);
    return $res;
}
$notsp = notsp($nodatamsg);

if ($notsp == "") {
  echo "<script> location.href='../home.php'</script>";
} else {

  if ($mediaex != "") {
    $mediadata = getdate()[0];
    $median = "$id$mediadata.$mediaex";
    $mediadir = "../posts/";
    move_uploaded_file($_FILES['postmedia']['tmp_name'], $mediadir . $median);

    $sql = "INSERT INTO posts (user_id, tipo, midia, conteudo) values('$id', 1, '$median', '$postmsg')";
    $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro ao fazer postagem.') </script> <script> window.history.back() </script>");
    if (mysqli_affected_rows($conn)){
      echo "<script> location.href='../home.php'</script>";
    }
    else {
      echo "<script> window.alert('Erro fazer postagem.') </script>";
      echo "<script> location.href='../home.php'</script>";
    }
  } else {
    $sql = "INSERT INTO posts (user_id, conteudo) values('$id', '$postmsg')";
    $query = mysqli_query($conn, $sql) or die ("<script> window.alert('Erro ao fazer postagem.') </script> <script> window.history.back() </script>");
    if (mysqli_affected_rows($conn)){
      echo "<script> location.href='../home.php'</script>";
    }
    else {
      echo "<script> window.alert('Erro fazer postagem.') </script>";
      echo "<script> location.href='../home.php'</script>";
    }
  }

}
?>
