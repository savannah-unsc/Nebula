<?php
session_start();
$c2FA = $_SESSION['auth_secret'];
$email = $_SESSION['email'];
$senha = $_SESSION['senha'];
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

$sql = "select * from login where email = '$email' and senha = '$senha'";
$query = mysqli_query($conn, $sql) or die ("Erro!");

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$id = $tabela["id"];
$_SESSION['id'] = $id;
}

echo "<script> location.href='../home.php'</script>";

?>