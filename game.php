<?php
include "header.php"; ?>
<link href="css/game.css" rel="stylesheet">

<div class="column thin" style="margin-right: 30px; padding-top: 10px;">
  <div class="uk-card uk-card-default uk-card-body uk-animation-slide-left-medium">
      <div class="uk-card-header">
          <div class="uk-grid-small uk-flex-middle" uk-grid>
              <div class="uk-width-auto">
                  <img class="uk-border-circle" width="40" height="40" src="https://upload.wikimedia.org/wikipedia/commons/8/87/Avatar_poe84it.png">
              </div>
              <div class="uk-width-expand">
                  <h3 class="uk-card-title uk-margin-remove-bottom">User1</h3>
                  <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">score</time></p>
              </div>
          </div>
      </div>
      <div class="uk-card-body">
          <p>ssdnfkdskf</p>
      </div>
      <div class="uk-card-footer">
          <a href="#" class="uk-button uk-button-text">Read more</a>
      </div>
  </div>
</div>
<div class='column large' id='grid'>
  <?php
  for ($col = 0; $col < 20; $col++) { ?>
    <div class="ligne">
      <?php
      for ($ligne = 0; $ligne < 20; $ligne++) { ?>
        <div class='cellule' id='cellule_<?php echo $col . "_" . $ligne;?>'></div>
        <?php } ?>
    </div>
    <?php }?>
</div>
<div class="column thin" style="margin-left: 30px; padding-top: 10px;">
    <div class="uk-card uk-card-default uk-card-body uk-animation-slide-right-medium">
      <div class="uk-card-header">
          <div class="uk-grid-small uk-flex-middle" uk-grid>
              <div class="uk-width-auto">
                  <img class="uk-border-circle" width="40" height="40" src="http://www.freeiconspng.com/uploads/face-avatar-png-14.png">
              </div>
              <div class="uk-width-expand">
                  <h3 class="uk-card-title uk-margin-remove-bottom">User2</h3>
                  <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">score</time></p>
              </div>
          </div>
      </div>
      <div class="uk-card-body">
          <p>ssdnfkdskf</p>
      </div>
      <div class="uk-card-footer">
          <a href="#" class="uk-button uk-button-text">Read more</a>
      </div>
  </div>
</div>
<?php include "footer.php";?>


<script>
  $(document).ready(function() {
    $( "#grid .cellule" ).hover(function(e) {
      console.log(e.target.id);
    });
  });
</script>
