<style>

#navbar{
height: 10vh;
width: 100vw;
display: grid;
grid-template-columns: 20vw 80vw;
}
#logo{
background-image: url(../img/logos/white.png);
background-size: 15vw;
background-position: center;
background-repeat: no-repeat;
transition: 0.3s;
}
#logo:hover{
background-image: url(../img/logos/gray.png);
}
#logobtn{
margin-top: 1vh;
margin-left: 1vw;
height: 8vh;
width: 18vw;
background-color: #0000;
border: hidden;
}
#navicodiv{
display: grid;
grid-template-columns: 0.5vw 4vw 0.5vw;
grid-auto-rows: 0.5vw 4vw 0.5vw;
margin-left: 75vw;
}
#navico{
background-size: cover;
background-position: center;
background-repeat: no-repeat;
grid-row-start: 2;
grid-row-end: 3;
grid-column-start: 2;
grid-column-end: 3;
border-radius: 100%;
border: 0.4vh solid #2F3136;
transition: 0.3s
}
#navico:hover{
border: 0.4vh solid #40444B;
}
.navbtn{
margin-top: 1vh;
margin-left: 1vw;
height: 8vh;
width: 3vw;
background-color: #0000;
border: hidden;
}
</style>

<div id="navbar">
  <form id="logo" action="home.php" method="post"><input id="logobtn" type="submit" value=""></form>
  <div id="navicodiv"> <?php echo "<form id='navico' action='meuperfil.php' style='background-image: url(img/user_icons/$icone);'> <input class='navbtn' type='submit' value=''> </form>";?> </div>
</div>