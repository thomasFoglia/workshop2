<?php

//$numJoueur = $_POST['numJoueur'];
$numJoueur = 1;

$currentGrid = [
//  0   1  2  3  4  5  6  7  8  9 10 11  12 13 14 15 16 17 18
    [0, 0, 1, 0, 0, 2, 2, 1, 0, 1 ,0 ,1 , 1, 1, 1, 0, 0, 0, 0],//0
    [0, 0, 0, 0, 2, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//1
    [0, 0, 0, 0, 2, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//2
    [0, 0, 0, 0, 1, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//3
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//4
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//5
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//6
    [0, 1, 1, 0, 0, 1, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//7
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//8
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//9
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//10
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//11
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//12
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//13
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//14
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//15
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//16
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//17
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0]//18
];

// parcourt la grid
foreach($currentGrid as $ligne) {
  $width = 0;
  $highest = [];
  $init_y = -1;
  $l_inc = 0;
  // parcourt la ligne
  foreach ($ligne as $key => $value) {
    // c'est la bonne valeur
    if ($value == $numJoueur) {
      if ($init_y == -1 || $wrong == 1) {
        $init_y = $key;
      }
      $end_y = $key;
      $width ++;
      $highest[] = array("init_y" => $init_y, "end_y" => $end_y, "width" => $width);
      $wrong = 0;
    } else {
      // pas la bonne valeur
      // on retinitialise le comptage
      if ($width != 0) {
        $wrong = 1;
        $width--;
      }
    }
  }

  $highest = getHighestSerie($highest);
  $highest_all[] = $highest; // va contenir toutes les series max de chaque ligne
  $l_inc++;
}

var_dump($highest_all);

// retourne la plus grande série de la ligne
function getHighestSerie($array) {
  $h = 0;
  $final = [];
  foreach ($array as $a) {
    if ($a["width"] > $h) {
      $final = $a;
      $h = $a["width"];
    }
  }
  return $final;
}

?>
