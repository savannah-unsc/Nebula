setInterval(myMethod, 500);

function myMethod( )
{
    $(function(){
            $.ajax({
                url: "../php/mppostload.php",
                success: function(result){
                    $("#myposts").html(result);
                },
                error: function(){
                    $("#myposts").html("Error");
                }
        });
    }); 
}