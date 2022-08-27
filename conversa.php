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
    echo("<form action='php/envia.php' method='post' id='tbox'>
    <textarea type='text' maxlength='450' name='msg' id='ctxt' placeholder='O que você tem a dizer?' required> </textarea>
    <!--input type='text' maxlength='450' name='msg' id='ctxt' placeholder='O que você tem a dizer?' required-->
    <input type='hidden' value='$idchat' name='destinatario'>
    <input type='submit' value='' id='envtxt'>
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
<div id="msgboxs">
<?php

$sql = "select * from chat where remetente = $idchat and destinatario = $id or remetente = $id and destinatario = $idchat order by datahora";

$resultado=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($resultado))
{
    $idr = $tabela["remetente"];
    $msg = base64_decode($tabela["mensagem"]);
    $datahora = $tabela["datahora"];

    $ano = date('Y');
            $mes = date('m');
            $dia = date('d');
            $anomsg = substr($datahora, 0, 4);
            $mesmsg = substr($datahora, 5, 2);
            $diamsg = substr($datahora, 8, 2);
            $horamsg = substr($datahora, 11, 5);
            $tempo = "0";

            switch ($mesmsg) {
              case 1:
                $mesmsgs = "jan";
              break;
              case 2:
                $mesmsgs = "fev";
              break;
              case 3:
                $mesmsgs = "mar";
              break;
              case 4:
                $mesmsgs = "abr";
              break;
              case 5:
                $mesmsgs = "mai";
              break;
              case 6:
                $mesmsgs = "jun";
              break;
              case 7:
                $mesmsgs = "jul";
              break;
              case 8:
                $mesmsgs = "ago";
              break;
              case 9:
                $mesmsgs = "set";
              break;
              case 10:
                $mesmsgs = "out";
              break;
              case 11:
                $mesmsgs = "nov";
              break;
              case 12:
                $mesmsgs = "dez";
              break;
            }

            if ($dia == $diamsg and $mes == $mesmsg and $ano == $anomsg) {
              $tempo = "Hoje às $horamsg";
            } else {
              if ($mes == "$mesmsg" and $ano == $anomsg) {
                $tempo = "Dia $diamsg às $horamsg";
              } else {
                if ($ano == $anomsg) {
                  $tempo = "$diamsg de $mesmsgs. às $horamsg";
                } else {
                  $tempo = "$diamsg/$mesmsg/$anomsg às $horamsg";
                }
              }
            }

    if ($id == $idr) {
        $color = "#A569BD";
        $user = $mainuser;
        $uid = $mainuid;
        $idmsg = $id;
      } else {
        $color = "#1ABC9C";
        $user = $chatuser;
        $uid = $chatuid;
        $idmsg = $idr;
      }

    if ($lastid != $idmsg) {
      echo "<div class='spmsg'> </div>
      <div class='msg'>
              <h3 style='color: $color;'> $user#$uid <b class='tempo gray'>$tempo</b></h3>
              <p> $msg </p>
            </div>";
            $lastid = $idmsg;
            $contador = 0;
    } else {
      echo "<div class='msg'>
              <p> $msg </p>
            </div>";
            $lastid = $idmsg;
            $contador = $contador + 1;

            if ($contador > 3) {
              $contador = 0;
              $lastid = 0;
            }
    }
    

}

$sql = "UPDATE chat set lida= 1 where destinatario='$id' and remetente = '$idchat'";
$query = mysqli_query($conn, $sql) or die ("");

?>
</div>
</div>
</div>

<script>

var objDiv = document.getElementById("msgboxs");
objDiv.scrollTop = objDiv.scrollHeight;

</script>

</body>
</html>