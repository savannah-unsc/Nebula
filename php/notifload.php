<?php

ini_set('display_errors', 0);
error_reporting(0);

include 'conexao.php';
include 'mostralink.php';

session_start();
$id = $_SESSION['id'];

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

        $msg = htmlspecialchars($msg);
        $msg = MontarLink($msg);

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

        $msg = htmlspecialchars($msg);
        $msg = MontarLink($msg);

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