setInterval(myMethod, 500);

function myMethod( )
{
    $(function(){
            $.ajax({
                url: "../php/chatload.php",
                success: function(result){
                    $(".msgbox").html(result);
                },
                error: function(){
                    $(".msgbox").html("Erro ao carregar o chat  ");
                }
        });
    }); 
}