<?php
session_start();
$id = $_SESSION['id'];
$c2FA = $_SESSION['auth_secret'];
$code = $_POST['code'];

include ("conexao.php");
require "Authenticator.php";

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo "<script> window.alert('Erro') </script>";
    header("location: ../2FAadd.php");
    die();
}
$Authenticator = new Authenticator();

$checkResult = $Authenticator->verifyCode($c2FA, $code, 2);

if (!$checkResult) {
    $_SESSION['failed'] = true;
    echo "<script> window.alert('Erro') </script>";
    header("location: ../2FAadd.php");
    die();
} 

$sql = "select * from login where id = $id";
$query = mysqli_query($conn, $sql) or die ("Erro!");

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$v2FA = $tabela["validade_2FA"];
}

if ($v2FA == 0) {
    $sql = "UPDATE login set validade_2FA = 1 where id = $id";
  $query = mysqli_query($conn, $sql) or die ("Erro");

  if (mysqli_affected_rows($conn)){
  echo "<script> location.href='../config.php'</script>";
  }
  else{
    echo "<script> location.href='../config.php'</script>";
  }
} else {
    $sql = "UPDATE login set validade_2FA = 0 where id = $id";
  $query = mysqli_query($conn, $sql) or die ("Erro");

  if (mysqli_affected_rows($conn)){
    echo "<script> location.href='../config.php'</script>";
  }
  else{
    echo "<script> location.href='../config.php'</script>";
  }
}

?>