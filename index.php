<?php
include "header.php";
?>

<script src="js/index.js"></script>

<div class="uk-cover-background">
    <img src="img/material-wpp2.jpg" alt="wpp" uk-cover>
    <div class="uk-section">
        <div class="uk-container" uk-scrollspy="target: > div; cls:uk-animation-kenburns;">
            <div class="uk-text-center huge-title" style="color: #37474f">Bienvenue</div>
            <div class="uk-text-center uk-text-large roboto-thin" style="color: #fff">Jeu de Pente</div>
        </div>
    </div>

    <div uk-scrollspy="target: > form; cls:uk-animation-fade;">
        <form method="GET" action="game.php">
            <div class="uk-text-center uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: users"></span>
                    <input name="teamName" class="uk-input uk-form-width-large" type="text" placeholder="Nom d'équipe">
                </div>
            </div>

            <div class="uk-text-center uk-margin">
                <select name="playerType" class="uk-select uk-form-width-large">
                    <option value="ia">Je suis une IA</option>
                    <option value"human">Je suis un humain</option>
                </select>
            </div>
    
            <div id="iaAddress" class="uk-margin uk-text-center">
                <div class="uk-inline uk-align-center">
                    <span class="uk-form-icon" uk-icon="icon: link"></span>
                    <input name="iaAddress" class="uk-input uk-form-width-large" type="text" placeholder="Adresse IA">
                </div>
            </div>

            <div class="uk-margin uk-text-center">
                <button type="submit" id="playButton" class="uk-button uk-button-text">JOUER</button>
            </div>
        </form>            
    </div>
</div>

<?php include "footer.php";?>