<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> API Riot Games </title>
    <link rel="stylesheet" href="league.css">
  </head>
  <body>

    <div id="head">
      <div id="logo"></div>
      <form method="post" enctype="multipart/form-data" action="league.php" id="form">
        <input type="text" placeholder="Nome de Usuário" name="user" required>
        <select name="region">
          <option value="br1"> Brasil </option>
          <option value="euw1"> Oeste Europeu </option>
          <option value="eun1"> Leste Europeu </option>
          <option value="jp1"> Japão </option>
          <option value="kr"> Coreia do Sul </option>
          <option value="la1"> América Latina Norte </option>
          <option value="la2"> América Latina Sul </option>
          <option value="na1"> América do Norte </option>
          <option value="oc1"> Oceania </option>
          <option value="ru"> Rússia </option>
          <option value="tr1"> Turquia </option>
        </select>
        <input type="submit" value="Procurar">
      </form>
      <div> <br> <center> <h1> DEBUG </h1> </center> </div>
    </div>

      <?php

      ini_set('display_errors', 0);
      error_reporting(0);

      $user = $_POST['user'];
      $region = $_POST['region'];
      $user = preg_replace('/\s+/', '', $user);

      $apikey = "RGAPI-9f871bcd-2e3b-4545-ab00-71bdb77c1102";
      $counter = 0;

      $url = "https://$region.api.riotgames.com/lol/summoner/v4/summoners/by-name/$user";

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      $headers = array(
        "X-Riot-Token: $apikey",
        "Content-Type: application/json",
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

      $resultado = curl_exec($curl);
      curl_close($curl);
      // var_dump($resultado);

      $arr = json_decode($resultado);

      foreach($arr as $key => $value) {
        $lolid = $arr->id;
        $accountId = $arr->accountId;
        $puuid = $arr->puuid;
        $name = $arr->name;
        $profileIconId = $arr->profileIconId;
        $revisionDate = $arr->revisionDate;
        $summonerLevel = $arr->summonerLevel;
      }

      echo "<div id='perico' style='background-image: url(http://ddragon.leagueoflegends.com/cdn/12.5.1/img/profileicon/$profileIconId.png);'></div>";
      echo "<br><br>";
      echo "<h1> $name <b id='lvl'> $summonerLevel </b> </h1>";

      $url = "https://$region.api.riotgames.com/lol/spectator/v4/active-games/by-summoner/$lolid";

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      $headers = array(
        "X-Riot-Token: $apikey",
        "Content-Type: application/json",
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

      $resultado = curl_exec($curl);
      curl_close($curl);
      // var_dump($resultado);

      $arr = json_decode($resultado);

      foreach($arr as $key => $value) {
        $gameMode = $arr->gameMode;
        $gameLength = $arr->gameLength;
      }

      if(isset($gameMode)){

        switch ($gameMode) {
          case "ARAM":
          echo "<h3> Em partida </h3>
          <h2> Howling Abyss </h2>";
            break;
          case "CLASSIC":
            echo "<h3> Em partida </h3>
            <h2> Summoner's Rift </h2>";
            break;
          case "TUTORIAL":
          echo "<h3> Em partida </h3>
          <h2> Tutorial </h2>";
            break;
          case "URF":
          echo "<h3> Em partida </h3>
          <h2> URF </h2>";
            break;
          case "ONEFORALL":
          echo "<h3> Em partida </h3>
          <h2> Todos por Um </h2>";
            break;
          case "ARSR":
          echo "<h3> Em partida </h3>
          <h2> Summoner's Rift todo Aleatórios </h2>";
            break;
          case "GAMEMODEX":
          echo "<h3> Em partida </h3>
          <h2> Modo de Jogo Rotativo </h2>";
            break;
          case "NEXUSBLITZ":
          echo "<h3> Em partida </h3>
          <h2> Blitz do Nexus </h2>";
            break;
          case "ULTBOOK":
          echo "<h3> Em partida </h3>
          <h2> Livro Supremo das Ultimates </h2>";
            break;
      }
      echo "<h3> há " . intval($gameLength / 60) + 3 . " minutos </h3>";
      } else {
        echo "<h3> Fora de partida </h3>";
      }

      exit;
    ?>
  </body>
</html>
