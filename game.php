<?php
include "header.php"; ?>
<link href="css/game.css" rel="stylesheet">

<div class="column thin">
  SCORE
</div>
<div class='column large' id='grid'>
  <?php
  for ($i = 0; $i < 20; $i++) { ?>
    <div style="display: inline-block; float: left; width: 31px;">
      <?php
      $p = 0;
      for ($p; $p < 20; $p++) { ?>
        <div class='cellule' id='cellule_<?php echo $i . "_" . $p;?>'></div>
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
