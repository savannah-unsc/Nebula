<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nebula </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/conversa.css">
</head>
<body>
<?php
include 'php/conexao.php';

ini_set('display_errors', 0);
error_reporting(0);

session_start();
$id = $_SESSION['id'];

if(isset($id) == false){
	echo "<script> location.href='entrar.html'</script>";
}

$sql = "select * from users where id = $id";

$resultado=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($resultado))
{
$mainuser = $tabela["usuario"];
$mainuid = $tabela["uid"];
}

$idchat = $_GET['id'];
$_SESSION['idchat'] = $idchat;

if (isset($idchat) == false) {
    $idchat = $id;
}

if (isset($idchat) == true) {
    $sql = "select * from users where id = $idchat";

$resultado=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($resultado))
{
$chatuser = $tabela["usuario"];
$chatuid = $tabela["uid"];
$chaticon = $tabela["icon"];
$chatban = $tabela["banner"];
}
}

if ($idchat == $id) {
    echo("<form action='#' method='post' id='tbox'>
    <input type='text' maxlength='450' id='ctxt' placeholder='O que você tem a dizer?' required disabled>
    <input type='submit' value='' id='envtxt'>
    </form>
");
} else {
    echo("<form action='php/envia.php' method='post' id='tbox' target='_BLANK' autocomplete='off'>
    <input type='text' maxlength='450' name='msg' id='ctxt' placeholder='O que você tem a dizer?' required>
    <input type='hidden' value='$idchat' name='destinatario'>
    <input type='submit' value='' id='envtxt' onclick='limpar()'>
    </form>
");
}


?>

<div id="corpo">
<div id="cont">
<form id="nebulahome" action="principal.php">
<input type="submit" value="" id="invbtn">
</form>
<div>
<?php

$sql = "select * from follow where idmaior = $id and maiormenor = 1 and menormaior = 1 or idmenor = $id and maiormenor = 1 and menormaior = 1";

$result=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($result))
{
$idmaior = $tabela["idmaior"];
$idmenor = $tabela["idmenor"];

if ($idmaior == $id) {
    $idconvidado = $idmenor;
} else {
    $idconvidado = $idmaior;
}

$sqla = "select * from users where id = $idconvidado";

$resultado=mysqli_query($conn,$sqla);
while($tabela=mysqli_fetch_array($resultado))
{
$convuser = $tabela["usuario"];
$convuid = $tabela["uid"];
$convicon = $tabela["icon"];
$convban = $tabela["banner"];

echo("<form class='contato' action='conversa.php'>
<input type='hidden' value='$idconvidado' name='id'>
<div style='background-image: url(img/user_banners/$convban)' class='convban'>
<div style='background-image: url(img/user_icons/$convicon)' class='convico'>
<input type='submit' value='' class='invbtn'>
</div>
</div>
<button type='submit' class='chatbtn'> <h1>$convuser<b class='gray'>#$convuid</b></h1> </button>
</form>");

}
}

?>
</div>
</div>
<div id="chat">
<?php

echo("<form action='perfil.php' id='nav'>
<div style='background-image: url(img/user_banners/$chatban)' id='chatban'>
<div style='background-image: url(img/user_icons/$chaticon)' id='chaticon'>
<input type='hidden' value='$idchat' name='id'>
<input type='submit' value='' id='invbtn'>
</div>
</div>
<button id='navbtn'>
<h1>$chatuser<b class='gray'>#$chatuid</b></h1>
</button>
</form>");
?>
<div id="msgboxs" class="msgbox">
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="js/chatload.js"></script>
<script>
var objDiv = document.getElementById("msgboxs");
objDiv.scrollTop = objDiv.scrollHeight;

function limpar(){
    setTimeout(limpeza, 500);
    function limpeza(){
        objDiv.scrollTop = objDiv.scrollHeight;
        document.getElementById('ctxt').value='';
    }
}

</script>

<script>
    var input = document.getElementById("envtxt");
    input.addEventListener("keyup", function(event) {
         if (event.keyCode === 13) {
            event.preventDefault();
             document.getElementById("botaoForm").click();
        }
    });
</script>

</body>
</html>