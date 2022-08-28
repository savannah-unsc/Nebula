<?php
ini_set('display_errors', 0);
error_reporting(0);

require 'conexao.php';

session_start();
$id = $_SESSION['id'];
$idchat = $_SESSION['idchat'];

$sql = "select * from users where id = $id";

$resultado=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($resultado))
{
$mainuser = $tabela["usuario"];
$mainuid = $tabela["uid"];
}

$sql = "select * from users where id = $idchat";

$resultado=mysqli_query($conn,$sql);
while($tabela=mysqli_fetch_array($resultado))
{
$chatuser = $tabela["usuario"];
$chatuid = $tabela["uid"];
$chaticon = $tabela["icon"];
$chatban = $tabela["banner"];
}

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
}
}

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