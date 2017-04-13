<?php

//$numJoueur = $_POST['numJoueur'];
$numJoueur = 1;

$currentGrid = [
//  0   1  2  3  4  5  6  7  8  9 10 11  12 13 14 15 16 17 18
    [0, 0, 1, 1, 0, 2, 2, 1, 0, 1 ,0 ,1 , 0, 1, 1, 0, 0, 0, 0],//0
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
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 1, 0, 0, 0, 0],//17
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0]//18
];

$to_play_line = getToPlayLine($currentGrid, $numJoueur);
var_dump($to_play_line);



/************************************************ FONCTIONS ************************************************************/

// retourne le coup à jouer
function getToPlayLine($currentGrid, $numJoueur) {
  // les series les plus hautes de chaque ligne
  $highests_series_lines = getHighestsAllLine($currentGrid, $numJoueur);

  //var_dump($highests_series_lines);die();
  // tri de ce tableau dans l'ordre décroissant des longeurs de séries
  $sorted = sortArrayWidthDesc($highests_series_lines);
  // retourne le coup à jouer
  $to_play_line = to_play_line($currentGrid, $sorted);

  return $to_play_line;
}

// retourne le coup à jouer
function to_play_line($currentGrid, $sorted) {
  //var_dump($sorted);
  //var_dump($currentGrid);

  foreach ($sorted as $key => $value) { // nos valeurs
    $x = $value["x"];
    $y_init = $value["init_y"];
    $y_end = $value["end_y"];
    $impossible = false;
    if (isset($currentGrid[$x][$y_init - 1])) {   // on peut le placer a gauche

      if ($currentGrid[$x][$y_init - 1] == 0) { // si a gauche est libre
        // var_dump($currentGrid[$x][$y_init -1]);
        return array($x, $y_init - 1);
      } else {
        return coupRandom($currentGrid);
      }
    } else if (isset($currentGrid[$x][$y_init + 1])) { // on peut le placer a droite
      if ($currentGrid[$x][$y_init + 1] == 0) { // si a droite est libre
        return array($x, $y_init + 1);
      } else {
          return coupRandom($currentGrid);
      }
    } else {
      return coupRandom($currentGrid);
    }
  }

  return true;
}

// retourne au hasard une case qui a une valeur 0
function coupRandom($currentGrid) {
  //var_dump($currentGrid);
  $array_empty = array();
  foreach ($currentGrid as $key_x => $all_x) {
    foreach ($all_x as $key_y => $y) {
      if ($currentGrid[$key_x][$key_y] == 0) {
        $array_empty[] = array($key_x, $key_y);
      }
    }
  }
  return $array_empty[array_rand($array_empty)];
}


// retourne le tableau avec les width dans l'ordre décroissant
// = les series de plus interessantes à jouer vers les moins interessantes
function sortArrayWidthDesc($highests_series_lines) {
  $final = [];
  for ($i=19 ; $i > 0 ; $i--) {
    foreach ($highests_series_lines as $key => $value) {
      if ($value["width"] == $i) {
        $value = array('x' => $key) + $value; // add du X
        $final[] = $value;
      }
    }
  }

  return $final;
}



function getHighestsAllLine($currentGrid, $numJoueur) {
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
      $l_inc++;
    }

    $highest = getHighestSerie($highest);
    $highest_all[] = $highest; // va contenir toutes les series max de chaque ligne

  }
  return array_filter($highest_all); // supprime les array vides
}

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
