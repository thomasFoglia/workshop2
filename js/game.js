$(document).ready(function() {
    $(".cellule").on("mouseleave", function() {
        $(".cellule > .temp_circle").remove();
    });

    $(".cellule").on("mouseenter", function() {
        $("#" + this.id).append('<img src="img/circley.png" class="temp_circle" width="20" height="20" style="margin-left: auto; margin-right: auto; display: block;position: absolute;"/>');
    });

    $(".cellule").on("click", function() {
        cell_split = this.id.split('_');
        addPt1(cell_split[1], cell_split[2]);
        $(this).find('.temp_circle').removeAttr('class');
    });
});

function addPt1(x, y) {
    if ($("#cellule_" + x + "_" + y).is(":empty")) {
        $("#cellule_" + x + "_" + y).append('<img src="img/circleb.png" width="20" height="20" style="margin-left: auto; margin-right: auto; display: block;position: absolute;"/>');
    }
}

function addPt2(x, y) {
    if ($("#cellule_" + x + "_" + y).is(":empty")) {
        $("#cellule_" + x + "_" + y).append('<img src="img/circley.png" width="20" height="20" style="margin-left: auto; margin-right: auto; display: block;position: absolute;"/>');
    }
}

function removePt(x, y) {
    $("#cellule_" + x + "_" + y).html("");
}
