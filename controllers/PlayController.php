<?php
class PlayController
{
  public function getAction($request) {
    $data = [];
    if (isset($request->url_elements[2]) && $request->url_elements[2] != ''
    && isset($request->url_elements[3]) && $request->url_elements[3] != ''
    && isset($request->url_elements[4]) && $request->url_elements[4] != '') {

      $x = $request->url_elements[2];
      $y = $request->url_elements[3];
      $nomJoueur = $request->url_elements[4];
      $tab = $_SESSION["tableau"];

      //Si case non vide alors error 406
      if ($tab[$x][$y] != 0) {
        return;//ERROR 406 a renvoyer
      }
      
      //Si non on valide le coup et procèdons aux cacluls

      //Joueur 1 ou 2 ?
      if ($_SESSION["j1"]["nomJoueur"] == $nomJoueur) {
        $numJoueur = 1;
      }
      else if ($_SESSION["j2"]["nomJoueur"] == $nomJoueur) {
        $numJoueur = 2;
      }
      else {
        //Un joueur non inscrit essaie de nous faire du mal, et on est pas venus ici pour souffrir okay ???
        return;
      }
      
      //Place le point, on garde le tableau d'avant pour calculer les tenailles
      $prevArray = $tab[$x][$y];
      $_SESSION["lastX"] = $x;
      $_SESSION["lastY"] = $y;
      $tab[$x][$y] = $numJoueur;

      //Calcul des tenailles
      $newTenaillesCount= countTenailles($tab);
      
      $_SESSION["j1"]["nbTenailles"] = newTenaillesCount["j1"];
      $_SESSION["j2"]["nbTenailles"] = newTenaillesCount["j2"];
      
      //Tour par tour (joueur x puis joueur y)
      if ($_SESSION["turn"] == 0) {
        $_SESSION["turn"] = 1;
      } else if ($_SESSION["turn"] == 1) {
        $_SESSION["turn"] = 0;
      }

      $data = array("code" => 200);
    }
    return $data;
  }

  private function isLineCompleted() {
    $pts = [];
    $isWinner = false;

    //Pour chaque ligne
    $i = 0;
    foreach($arr as $ligne) {
        //Pour chaque cellule d'une ligne
        $j = 0;
        foreach($ligne as $cell) {
            //Si la case n'est pas vide elle appartient a un joueur
            if ($cell == $numJoueur) {
                $pts[] = [$j, $i];
            }
            $j++;
        }
        $i++;
    }

    foreach ($pts as $pt) {
      //Est-ce qu'un pion m'appartenant est a coté de mon $pt ?
      
      //À droite ?
      if ($pt[0] != 18 && $arr[$pt[1]][$pt[0] + 1] == $numJoueur) {
          if ($pt[0] + 1 != 18 && $arr[$pt[1]][$pt[0] + 2] == $numJoueur) {
              if ($pt[0] + 2 != 18 && $arr[$pt[1]][$pt[0] + 3] == $numJoueur) {
                  if ($pt[0] + 3 != 18 && $arr[$pt[1]][$pt[0] + 4] == $numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }
      
      //À gauche ?
      if ($pt[0] != 0 && $arr[$pt[1]][$pt[0] - 1] == $numJoueur) {
          if ($pt[0] - 1 != 0 && $arr[$pt[1]][$pt[0] - 2] == $numJoueur) {
              if ($pt[0] - 2 != 0 && $arr[$pt[1]][$pt[0] - 3] == $numJoueur) {
                  if ($pt[0] - 3 != 0 && $arr[$pt[1]][$pt[0] - 4] == $numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }
      
      //En bas ?
      if ($pt[1] != 18 && $arr[$pt[1] + 1][$pt[0]] == $numJoueur) {
          if ($pt[1] + 1 != 18 && $arr[$pt[1] + 2][$pt[0]] == $numJoueur) {
              if ($pt[1] + 2 != 18 && $arr[$pt[1] + 3][$pt[0]] == $numJoueur) {
                  if ($pt[1] + 3 != 18 && $arr[$pt[1] + 4][$pt[0]] == $numJoueur) {
                      $isWinner = true;
                      break;              
                  }
              }
          }
      }

      //En haut ?
      if ($pt[1] != 0 && $arr[$pt[1] - 1][$pt[0]] == $numJoueur) {
          if ($pt[1] -1 != 0 && $arr[$pt[1] - 2][$pt[0]] == $numJoueur) {
              if ($pt[1] -2 != 0 && $arr[$pt[1] - 3][$pt[0]] == $numJoueur) {
                  if ($pt[1] -3 != 0 && $arr[$pt[1] - 4][$pt[0]] == $numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }
      
      //Diago haut droite
      if ($pt[0] != 18 && $pt[1] != 0 && $arr[$pt[1] - 1][$pt[0] + 1] == $numJoueur) {
          if ($pt[0] + 1 != 18 && $pt[1] - 1 != 0 && $arr[$pt[1] - 2][$pt[0] + 2] == $numJoueur) {
              if ($pt[0] + 2 != 18 && $pt[1] - 2 != 0 && $arr[$pt[1] - 3][$pt[0] + 3] == $numJoueur) {
                  if ($pt[0] + 3 != 18 && $pt[1] - 3 != 0 && $arr[$pt[1] - 4][$pt[0] + 4] == $numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }

      
      //Diago haut gauche
      if ($pt[0] != 0 && $pt[1] != 0 && $arr[$pt[1] - 1][$pt[0] - 1] == $numJoueur) {
          if ($pt[0] - 1 != 0 && $pt[1] - 1 != 0 && $arr[$pt[1] - 2][$pt[0] - 2] == $numJoueur) {
              if ($pt[0] - 2 != 0 && $pt[1] - 2 != 0 && $arr[$pt[1] - 3][$pt[0] - 3] == $numJoueur) {
                  if ($pt[0] - 3 != 0 && $pt[1] - 3 != 0 && $arr[$pt[1] - 4][$pt[0] - 4] == $numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }

      //Diago bas droite
      if ($pt[0] != 18 && $pt[1] != 18 && $arr[$pt[1] + 1][$pt[0] + 1] == $numJoueur) {
          if ($pt[0] + 1 != 18 && $pt[1] + 1 != 18 && $arr[$pt[1] + 2][$pt[0] + 2] == $numJoueur) {
              if ($pt[0] + 2 != 18 && $pt[1] + 2 != 18 && $arr[$pt[1] + 3][$pt[0] + 3] == $numJoueur) {
                  if ($pt[0] + 3 != 18 && $pt[1] + 3 != 18 && $arr[$pt[1] + 4][$pt[0] + 4] == $numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }

      //Diago bas gauche
      if ($pt[0] != 0 && $pt[1] != 18 && $arr[$pt[1] + 1][$pt[0] - 1] == $numJoueur) {
          if ($pt[0] - 1 != 0 && $pt[1] + 1 != 18 && $arr[$pt[1] + 2][$pt[0] - 2] == $numJoueur) {
              if ($pt[0] - 2 != 0 && $pt[1] + 2 != 18 && $arr[$pt[1] + 3][$pt[0] - 3] == $numJoueur) {
                  if ($pt[0] - 3 != 0 && $pt[1] + 3 != 18 && $arr[$pt[1] + 4][$pt[0] - 4] == $numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }
    }

    if ($isWinner) {
      return true;
    }
    else {
      return false;
    }
  }

  private function countTenailles($arr) {
    //voir algo tenailles
  }
}
?>
