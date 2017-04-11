$(document).ready(function() {

});

function addPt(x, y) {
    $("#cellule_" + x + "_" + y).append('<img src="img/circleb.png" width="15" height="15" style="margin-left: auto; margin-right: auto; display: block;"/>');
}

function removePt(x, y) {
    $("#cellule_" + x + "_" + y).html("");
}