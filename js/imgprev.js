document.addEventListener("DOMContentLoaded", function(){
  document.querySelector("#upico").addEventListener("change", function(imagem){
  const arquivo = imagem.target.files.item(0);
  const endereco = new FileReader();
  endereco.onloadend = function(){
    document.querySelector("#icon").setAttribute("style", "background-image: url(" + endereco.result );
  }
  endereco.readAsDataURL(arquivo);
});
});

document.addEventListener("DOMContentLoaded", function(){
  document.querySelector("#upban").addEventListener("change", function(imagem){
  const arquivo = imagem.target.files.item(0);
  const endereco = new FileReader();
  endereco.onloadend = function(){
    document.querySelector("#banner").setAttribute("style", "background-image: url(" + endereco.result );
  }
  endereco.readAsDataURL(arquivo);
});
});

document.addEventListener("DOMContentLoaded", function(){
  document.querySelector("#postarfile").addEventListener("change", function(imagem){
  const arquivo = imagem.target.files.item(0);
  const endereco = new FileReader();
  endereco.onloadend = function(){
    document.querySelector("#postimagepreview").setAttribute("style", "background-image: url(" + endereco.result );
  }
  endereco.readAsDataURL(arquivo);
});
});
