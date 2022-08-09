<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Senha SHA256 </title>
  </head>
  <body>

  </body>
</html>

<?php

$senha ='#k51cUt^YF2WeQdQJl7%IoY3QccjM1$RyMUqndbPxN!5%WlPaE';
$senhaSHA = SHA1($senha);

echo "$senha ";
echo strlen($senha);
echo "<br>";
echo "$senhaSHA ";
echo strlen($senhaSHA);

 ?>
