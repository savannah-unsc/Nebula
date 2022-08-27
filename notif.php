<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/notif.css">
  </head>
  <body>

<?php
ini_set('display_errors', 0);
error_reporting(0);

include 'php/conexao.php';

session_start();
$id = $_SESSION['id'];

if(isset($id) == false){
	echo "<script> location.href='entrar.html'</script>";
}

$sql = "select * from users where id='$id'";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$icone = $tabela["icon"];
$usuario = $tabela["usuario"];
}

include 'php/navmain.php';
?>
<div id="corpo">
<?php

$sql = "select * from notifications where destinatario='$id' order by id desc";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$interacao = $tabela["interacao"];
$remetente = $tabela["remetente"];
$tipo = $tabela["tipo"];

$sqla = "select * from users where id = $remetente";

    $resultado=mysqli_query($conn,$sqla);
    while($table=mysqli_fetch_array($resultado))
    {
        $nuser = $table["usuario"];
        $nuid = $table["uid"];
        $nicon = $table["icon"];
    }

if ($tipo == 0) {
    $sqlb = "select * from comments where id = $interacao";

    $resul=mysqli_query($conn,$sqlb);
    while($tab=mysqli_fetch_array($resul))
    {
        $postid = $tab["post_id"];
        $msg = base64_decode($tab["msg"]);

        echo "<div class='notdiv'>
        <div class='notnav'>
        <form action='perfil.php' style='background-image: url(img/user_icons/$nicon)' class='notico'>
        <input type='submit' value='' class='invbtn'>
        <input type='hidden' name='id' value='$remetente'>
        </form>
        <h1 class='name'> $nuser<b class='gray'>#$nuid</b></h1>
        </div>
        <p> Respondeu uma publicação: </p>
        <p> $msg </p>
        <form action='post.php' style='display: grid'>
        <input type='hidden' name='publicacao' value='$postid'>
        <input type='submit' value='Ver Mensagem' class='viewbtn'>
        </form>
        </div>";
    }
} else {
    $sqlc = "select * from chat where id = $interacao";

    $re=mysqli_query($conn,$sqlc);
    while($t=mysqli_fetch_array($re))
    {
        $msg = base64_decode($t["mensagem"]);

        echo "<div class='notdiv'>
        <div class='notnav'>
        <form action='perfil.php' style='background-image: url(img/user_icons/$nicon)' class='notico'>
        <input type='submit' value='' class='invbtn'>
        <input type='hidden' name='id' value='$remetente'>
        </form>
        <h1 class='name'> $nuser<b class='gray'>#$nuid</b></h1>
        </div>
        <p> Enviou uma mensagem: </p>
        <p> $msg </p>
        <form action='conversa.php' style='display: grid'>
        <input type='hidden' name='id' value='$remetente'>
        <input type='submit' value='Ver Mensagem' class='viewbtn'>
        </form>
        </div>";
    }
}
}

$sql = "UPDATE notifications set lida= 1 where destinatario='$id'";
$query = mysqli_query($conn, $sql) or die ("");

?>
</div>
<p id="end"> Você chegou ao fim da navegação! </p>
</body>
</html>