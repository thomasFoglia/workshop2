$(document).ready(function() {
  $(".cellule").click(function() {
    $("#" + this.id).html('<img src="img/circleb.png" width="15" height="15" style="margin-left: auto; margin-right: auto; display: block;"/>');
  });
});

function addPt1(x, y) {
  if ($("#cellule_" + x + "_" + y).is(":empty")) {
    $("#cellule_" + x + "_" + y).html('<img src="img/circleb.png" width="15" height="15" style="margin-left: auto; margin-right: auto; display: block;"/>');
  }
}

function addPt2(x, y) {
  if ($("#cellule_" + x + "_" + y).is(":empty")) {
    $("#cellule_" + x + "_" + y).html('<img src="img/circley.png" width="15" height="15" style="margin-left: auto; margin-right: auto; display: block;"/>');
  }
}

function removePt(x, y) {
    $("#cellule_" + x + "_" + y).html("");
}
