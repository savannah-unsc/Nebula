<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
  </head>
  <body>
  </body>
</html>

<?php

ini_set('display_errors', 0);
error_reporting(0);

session_start();
$id = $_SESSION['id'];

if(isset($id)){
	echo "<script> location.href='principal.php'</script>";
} else {
  echo "<script> location.href='entrar.html'</script>";
}

?>
