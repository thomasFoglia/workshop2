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
});
