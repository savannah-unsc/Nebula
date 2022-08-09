<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Nebula </title>
    <link rel="shortcut icon" href="nebula.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/estilo.css">
  </head>
  <body>

<?php
  $id = null;

  session_start();
  $_SESSION['id'] = $id;

  echo "<script> location.href='../entrar.html'</script>";

?>
