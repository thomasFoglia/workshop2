$(document).ready(function() {
    $("select[name='playerType']").change(function() {
        if ($("select[name='playerType']").val() == "ia") {
            $("#iaAddress").show();
        } else {
            $("#iaAddress").hide();
        }
    });
});