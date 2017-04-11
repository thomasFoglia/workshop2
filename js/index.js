$(document).ready(function() {
    // sur un "précédent"
    if ($("select[name='playerType']").val() != "ia") {
        $("#iaAddress").hide();
    }

    $("select[name='playerType']").change(function() {
        if ($("select[name='playerType']").val() == "ia") {
            $("#iaAddress").show();
        } else {
            $("#iaAddress").hide();
        }
    });

    $(form).submit(function(){
       $.ajax({
            url: url,
            type: GET,
            data: data,
            dataType: JSON,
            success: function(param){
            param = json.parse(param);
            code = param["code"];
               switch(code){
                case 200:
                    window.location.replace("game.php");
                    break;
                case 401:
                    //connection non autorisée
                    break;
                
                }
            }
         
        });  
       


    });
});
