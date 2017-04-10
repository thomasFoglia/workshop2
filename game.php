<?php
include "header.php"; ?>
<link href="css/game.css" rel="stylesheet">

<div class="column thin">
  SCORE
</div>
<div class='column large' id='grid'>
  <?php
  for ($col = 0; $col < 20; $col++) { ?>
    <div style="display: inline-block; float: left; width: 31px;">
      <?php
      for ($ligne = 0; $ligne < 20; $ligne++) { ?>
        <div class='cellule' id='cellule_<?php echo $col . "_" . $ligne;?>'></div>
        <?php } ?>
    </div>
    <?php }?>
</div>
<div class="column thin">
  SCORE
</div>
<?php include "footer.php";?>


<script>
  $(document).ready(function() {
    $( "#grid .cellule" ).hover(function(e) {
      console.log(e.target.id);
    });
  });
</script>
