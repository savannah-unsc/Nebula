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

$lold = $_POST['loginold'];
$pold = $_POST['passwordold'];
$lnew = $_POST['loginnew'];
$pnew = $_POST['passwordnew'];

$email = hash('sha256', $lold);
$senha = hash('sha256', $pold);

$sql = "select * from login where email='$email' and senha='$senha'";
$query = mysqli_query($conn, $sql) or die ("Email ou Senha incorretos!");

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$id = $tabela["id"];
}

if (isset($id) == true) {
    $email2 = hash('sha256', $lnew);
    $senha2 = hash('sha256', $pnew);
    
    $sql = "UPDATE login set email='$email2', senha='$senha2' where id='$id'";
    $query = mysqli_query($conn, $sql) or die ("Erro ao atualizar perfil!");
    if (mysqli_affected_rows($conn)){
    echo "<script> location.href='../config.php'</script>";
    }
    else{
    echo "<script> location.href='../config.php'</script>";
    }
} else {
    echo "<script> window.alert('Erro 2: Erro ao atualizar perfil!') </script>";
    echo "<script> window.history.back() </script>";
}
?>