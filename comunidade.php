<?php
include("php/conexao.php");

ini_set('display_errors', 0);
error_reporting(0);

session_start();
$id = $_SESSION['id'];
$idconvidado = $_SESSION['idconvidado'];

if ($id == $idconvidado) {
    echo "<script> location.href='meuperfil.php'</script>";
}


$sql = "select * from users where id='$idconvidado'";

$result = mysqli_query($conn, $sql);
while ($tabela = mysqli_fetch_array($result)) {
    $usuario = $tabela["usuario"];
    $uid = $tabela["uid"];
    $bio = base64_decode($tabela["bio"]);
    $banner = $tabela["banner"];
    $icon = $tabela["icon"];
    $seguindo = $tabela["seguindo"];
    $seguidores = $tabela["seguidores"];
    $tipo = $tabela["tipo"];
}

if ($tipo == 0) {
    echo "<script> location.href='perfil.php'</script>";
}

$bio = htmlspecialchars($bio);

if (isset($usuario) == false) {
    echo "<script> location.href='principal.php'</script>";
}

?>

<!DOCTYPE html>
<html lang='pt-br'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title> <?php echo "$usuario"; ?> | Nebula </title>
    <link rel='shortcut icon' href='../nebula.ico' type='image/x-icon' />
    <link rel='stylesheet' href='../css/profile.css'>
    <link rel='stylesheet' href='../css/estilo.css'>
    <link rel="stylesheet" href="../css/comunidade.css">
</head>

<body>
    <?php
    if ($id > $idconvidado) {
        $idmaior = $id;
        $idmenor = $idconvidado;
    } else {
        $idmaior = $idconvidado;
        $idmenor = $id;
    }

    $sql = "select * from follow where idmaior='$idmaior' and idmenor='$idmenor'";

    $result = mysqli_query($conn, $sql);
    while ($tabela = mysqli_fetch_array($result)) {
        $maiormenor = $tabela["maiormenor"];
        $menormaior = $tabela["menormaior"];
    }

    if (isset($maiormenor)) {
        if ($id == $idmaior) {
            if ($maiormenor == 0) {
                $seguir = "Seguir";
            } else {
                $seguir = "Seguindo";
            }
        } else {
            if ($menormaior == 0) {
                $seguir = "Seguir";
            } else {
                $seguir = "Seguindo";
            }
        }
    } else {
        $seguir = "Seguir";
    }

    $sql = "select * from users where id='$id'";

    $result = mysqli_query($conn, $sql);
    while ($tabela = mysqli_fetch_array($result)) {
        $icone = $tabela["icon"];
    }

    if (isset($id) == false) {
        include 'php/navnologin.php';
    } else {
        include 'php/navmain.php';
    }

    include 'php/scrtop.php';

    ?>

    <div id="perfil">
        <?php

        echo "<div id='banner' style='background-image: url(../img/user_banners/$banner);'>
        <div id='icon' style='background-image: url(../img/user_icons/$icon);'>
        ";
        ?>
    </div>
    </div>
    <form action="php/seguir.php" method="post">
        <?php
        echo "<input type='hidden' name='id' value='$idconvidado'>";
        echo "<h1 id='username'> $usuario<b class='gray'>#$uid</b> </h1>";
        ?>
        <input id="editbtn" type="submit" value="<?php echo "$seguir"; ?>">
        <?php
        echo "<p class='gray' id='bio'> $bio </p>";
        ?>
    </form>
    <div id="seg">
        <div id='seguindo'> <?php echo "<h1> Seguindo </h1> <h2 class='gray'> $seguindo </h2>"; ?> </div>
        <div id='seguido'> <?php echo "<h1> Seguidores </h1> <h2 class='gray'> $seguidores </h2>"; ?> </div>
    </div>
    </div>
    <form id="postarform" action="php/postarcom.php" enctype="multipart/form-data" method="post">
        <textarea name="postmsg" id="postararea" placeholder="Comente na comunidade <?php echo $usuario; ?>!" maxlength="512" required></textarea>
        <div id="postimagepreview" style=""></div>
        <label id="postarlab" for="postarfile"> </label>
        <input id="postarfile" type="file" name="postmedia" accept="image/*">
        <input id="postarbtn" type="submit" value="Publicar">
    </form>
    <div id="myposts" class="corpo"></div>
    <p id="end"> Você chegou ao fim da navegação! </p>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/ppostload.js"></script>
</body>

</html>