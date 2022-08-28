<style>
.vtop{
    background-color: #40444B;
    background-image: url(img/icons/upp.png);
    background-position: center;
    background-repeat: no-repeat;
    background-size: 3.5vh;
    height: 5vh;
    width: 5vh;
    position: fixed;
    margin-top: 75vh;
    margin-left: 90vw;
    border-radius: 100%;
    visibility: hidden;
    transition: 0.3s;
    transform: scale(0%);
}
.vtop:hover{
    background-image: url(img/icons/upp_hover.png);
    background-color: #2F3136;
}
.vtop.show{
    visibility: visible;
    transform: scale(100%);
}

@media screen and (min-device-width: 430px) and (max-device-width: 1024px) {
    .vtop{
    margin-top: 70vh;
    margin-left: 87.5vw;
}
}
@media screen and (max-device-width: 429px) {
    .vtop{
    margin-top: 70vh;
    margin-left: 85vw;
}
}

</style>

<div class="vtop"></div>

<script> window.addEventListener("scroll",function(){
    const lista = document.querySelector('.vtop');
    lista.classList.toggle('show', window.scrollY > 0);
    });
    document.querySelector('.vtop').addEventListener("click", function(){
        window.scrollTo(0,0);
    });
</script>