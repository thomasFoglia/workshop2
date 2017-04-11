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

    $("#playButton").click(function(e) {
        e.preventDefault();
        pseudo = $("#playerName").val();
        $.ajax({
            url: "server.php/connect/" + pseudo,
            type: "GET",
            data: [],
            dataType: 'json',
            success: function(result) {
                //param = JSON.parse(result);
                switch (result.code) {
                    case 200:
                        $("form").append('<input name="idJoueur" type="hidden" value="' + result.idJoueur + '" />')
                        $("form").append('<input name="nomJoueur" type="hidden" value="' + result.nomJoueur + '" />')
                        $("form").submit();

                        break;
                    case 401:
                        UIkit.notification("<span uk-icon='icon: warning'></span>&nbsp;&nbsp;&nbsp;Une partie est déjà en cours !", { status: "danger" });
                }
            }
        });

    });
});