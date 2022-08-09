<style>

#navbar{
height: 10vh;
width: 100vw;
display: grid;
grid-template-columns: 20vw 70vw 10vw;
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
.navbtn{
margin-top: 1vh;
margin-left: 1vw;
height: 8vh;
width: 3vw;
background-color: #0000;
border: hidden;
color: white;
transition: 0.3s;
}
.navbtn:hover{
color: #AFAFAF;
}

</style>

<div id="navbar">
  <form id="logo" action="home.php" method="post"><input id="logobtn" type="submit" value=""></form>
  <div></div>
  <form id="login" action="entrar.html"> <input class="navbtn" type="submit" value="Entrar"> </form>
</div>
