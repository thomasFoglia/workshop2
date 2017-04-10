<?php include "header.php"; ?>
<link href="css/game.css" rel="stylesheet">

<div>
  <div class="column thin">
    SCORE
  </div>
  <div class="column large" id="grid">
    <?php
    $i = 0;
    for ($i; $i < 20; $i++) {
      $p = 0;
      for ($p; $p < 20; $p++) { ?>
        <div class='cellule' id='cellule<?php echo $i . "_" . $p?>'>&nbsp;</div>
        <?php
      }
    } ?>
  </div>
  <div class="column thin">
    SCORE
  </div>
</div>

<script>
  $(document).ready(function() {
    $( "#grid .cellule" ).hover(function(e) {
      console.log(e.target.id);
    });
  });
</script>
