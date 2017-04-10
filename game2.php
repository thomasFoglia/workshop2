<?php
include "header.php"; ?>
<link href="css/game.css" rel="stylesheet">

<div class="column thin">
  SCORE
</div>
<div class='column large' id='grid'>
  <?php
  $i = 0;
  for ($i; $i < 20; $i++) { ?>
    <div style="display: inline-block; float: left; width: 31px;">
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
        <div style="border: solid black 1px; width: 31px; height: 31px;"></div>
    </div>
    <?php } ?>
</div>
<div class="column thin">
  SCORE
</div>
<?php include "footer.php";?>
