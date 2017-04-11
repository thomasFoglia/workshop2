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

    $("form").submit(function(e) {
       e.preventDefault();
      // alert("ok");
      pseudo = $(".playerName").val();
       $.ajax({
            url:"server.php/connect/"+pseudo,
            type: "GET",
            data: [],
            dataType: JSON,
            success: function(result) {
                param = json.parse(result);
                code = result["code"];
                switch (code) {
                    case 200:
                        window.location.replace("game.php");
                        break;
                    case 401:
                    //connection non autorisée
                       $(".uk-alert-warning").show();
                        break;
                }
            }
        });
       
    });
});