<?php
include "header.php";
if(!empty($_GET["serverUrl"]))
{
    $serverUrl = $_GET["serverUrl"];
}
else {
    //POUR LE DEV ENLEVER APRES
    $serverUrl = "http://monserver.fr/";
}

if(!empty($_GET["playerName"]))
{
    $playerName = $_GET["playerName"];
}
else {
    //POUR LE DEV ENLEVER APRES
    $playerName = "Je suis le joueur";
}
?>
    <link href="css/game.css" rel="stylesheet">
    <script src="js/game.js?v=<?=time();?>"></script>
    <script>
    $(document).ready(function(){
        var tenaillesPlayer1 = 0;
        var tenaillesPlayer2 = 0;
        var lastX = -99;
        var lastY = -99;
        var numTour = 0;

        setInterval(function() {
            $.get("<?=$serverUrl?>/turn/<?=$playerName?>", function(result){
                //Ce n'est pas a nous de jouer
                //if(result.status == 0) {
                if(false) {
                    $("#player2cardFooter").show();
                    $("#waitingPlayer2").css("display", "flex");

                    $("#player1cardFooter").show();
                    $("#player1turn").css("display", "flex");
                }
                else {
                    $("#player2cardFooter").hide();
                    $("#waitingPlayer2").css("display", "none");

                    $("#player1cardFooter").show();
                    $("#player1turn").css("display", "none");

                    $.post("server.php/ia", {"currentGrid": result.tableau, "tamere": "fdp"}, function(resultIA) {
                        //L'IA ME RENVOIE UNE POSITION
                        //Je joue en appellant /play/{x}/{y}/{nomJoueur}

                    });
                }

                //Le nombre de tenailles a changé
                if(result.nbTenaillesJ1 != tenaillesPlayer1) {
                    $("#tenaillesPlayer1").html(tenaillesPlayer1);
                    $("#player1HP").val(100 - (tenaillesPlayer1 * 20));
                }

                if(result.nbTenaillesJ2 != tenaillesPlayer2) {
                    $("#tenaillesPlayer2").html(tenaillesPlayer2);
                    $("#player2HP").val(100 - (tenaillesPlayer2 * 20));
                }

                //Un joueur a posé un pion
                if (result.dernierCoupX != lastX || result.dernierCoupY != lastY){
                    lastX = result.dernierCoupX;
                    lastY = result.dernierCoupY;
                    addPt2(lastX, lastY);
                }

                //Prolongation
                if (result.prolongation == "true") {
                    //Afficher un truc à l'écran
                }

                //Fin de la partie
                if (result.finPartie == true) {
                    //Envoyer en post result.detailFinPartie
                    href.location = "end.php";
                }

                if (result.numTour != numTour) {
                    $("#nbTour").html("Tour " + numTour);
                }
            });
        }, 500);
    });

    </script>

    <div class="column thin" style="margin-right: 30px; padding-top: 10px;">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <img class="uk-border-circle" width="40" height="40" src="https://upload.wikimedia.org/wikipedia/commons/8/87/Avatar_poe84it.png">
                    </div>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom"><?=$_GET["playerName"]?></h3>
                        <p class="uk-text-meta uk-margin-remove-top">
                            Tenailles : <span id="tenaillesPlayer1">0</span>
                        </p>
                    </div>
                </div>
                <progress id="player1HP" class="uk-progress" value="100" max="100"></progress>
            </div>
            <div class="uk-card-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
            <div id="player1cardFooter" class="uk-card-footer" style="display: none;">
                <div id="waitingPlayer1" style="display: none; align-items: center; justify-content: center;">
                    <div uk-spinner></div>
                    <div style="margin-left: 15px;">En attente du joueur</div>
                </div>

                <div id="player1turn" style="display: none; align-items: center; justify-content: center;">
                    <span class="uk-margin-small-right" uk-icon="icon: bell;"></span>
                    <div style="margin-left: 15px;">À ton tour</div>
                </div>
            </div>
        </div>

        <div><h1 id="nbTour" class="uk-heading-line uk-text-center"><span>Tour 0</span></h1></div>
    </div>
    <div class='column large' id='grid'>
        <?php
        for ($col = 0; $col < 19; $col++) { ?>
            <div class="ligne">
            <?php
                for ($ligne = 0; $ligne < 19; $ligne++) {
                  if ($ligne == 9 && $col == 9) {
                    ?><div class='cellule' id='cellule_<?php echo $col . '_' . $ligne; ?>'></div><?php
                  } else {
                    ?><div class='cellule' id='cellule_<?php echo $col . '_' . $ligne; ?>' style='background: url(img/cross.png)'></div><?php
                  }
                }
                ?>
            </div>
        <?php }?>
    </div>
    <div class="column thin" style="margin-left: 30px; padding-top: 10px;">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <img class="uk-border-circle" width="40" height="40" src="https://upload.wikimedia.org/wikipedia/commons/8/87/Avatar_poe84it.png">
                    </div>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom">Joueur 2</h3>
                        <p class="uk-text-meta uk-margin-remove-top">
                            Tenailles : <span id="tenaillesPlayer2">0</span>
                        </p>
                    </div>
                </div>
                <progress id="player2HP" class="uk-progress" value="100" max="100" style="background: red"></progress>
            </div>
            <div class="uk-card-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
            <div id="player2cardFooter" class="uk-card-footer" style="display: none;">
                <div id="waitingPlayer2" style="display: none; align-items: center; justify-content: center;">
                    <div uk-spinner></div>
                    <div style="margin-left: 15px;">En attente du joueur</div>
                </div>

                <div id="player2turn" style="display: none; align-items: center; justify-content: center;">
                    <span class="uk-margin-small-right" uk-icon="icon: bell;"></span>
                    <div style="margin-left: 15px;">Au jour du joueur 2</div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php";?>
