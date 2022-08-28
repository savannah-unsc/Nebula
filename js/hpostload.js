setInterval(myMethod, 500);

function myMethod( )
{
    $(function(){
            $.ajax({
                url: "../php/hpostload.php",
                success: function(result){
                    $(".postagens").html(result);
                },
                error: function(){
                    $(".postagens").html("Error");
                }
        });
    }); 
}