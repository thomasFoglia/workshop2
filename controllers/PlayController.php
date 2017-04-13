<?php
class PlayController
{
    public $arr = false;
    public $numJoueur = 0;
  public function getAction($request) {
    $data = [];
    if (isset($request->url_elements[2]) && $request->url_elements[2] != ''
    && isset($request->url_elements[3]) && $request->url_elements[3] != ''
    && isset($request->url_elements[4]) && $request->url_elements[4] != '') {

      $x = $request->url_elements[2];
      $y = $request->url_elements[3];
      $idJoueur = $request->url_elements[4];
      $this->arr = $_SESSION["tableau"];

      //Si case non vide alors error 406
      if ($this->arr[$x][$y] != 0) {
        return;//ERROR 406 a renvoyer
      }

      //Si non on valide le coup et procèdons aux cacluls

      //Joueur 1 ou 2 ?
      if ($_SESSION["j1"]["idJoueur"] == $idJoueur) {
        $this->numJoueur = 1;
      }
      else if ($_SESSION["j2"]["idJoueur"] == $idJoueur) {
        $this->numJoueur = 2;
      }
      else {
        //Un joueur non inscrit essaie de nous faire du mal, et on est pas venus ici pour souffrir okay ???
        return;
      }

      //Place le point, on garde le tableau d'avant pour calculer les tenailles
      $prevArray = $this->arr[$x][$y];
      $_SESSION["lastX"] = $x;
      $_SESSION["lastY"] = $y;
      $this->arr[$x][$y] = $this->numJoueur;
      $_SESSION["numTour"]++;

      if ($this->isLineCompleted()) {
        $_SESSION["gameEnded"] = true;
        $_SESSION["detailsGameEnd"] = $_SESSION["j".$this->numJoueur]["nomJoueur"] . " a aligné 5 pions";
      }

      $_SESSION["j".$this->numJoueur]["nbTenailles"] += $this->countTenailles();

      if ($_SESSION["j".$this->numJoueur]["nbTenailles"] == 5) {
        $_SESSION["gameEnded"] = true;
        $_SESSION["detailsGameEnd"] = $_SESSION["j".$this->numJoueur]["nomJoueur"] . " a effectué 5 tenailles";
      }

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

public function isLineCompleted() {
    $pts = [];
    $isWinner = false;

    //Pour chaque ligne
    $i = 0;
    foreach($this->arr as $ligne) {
        //Pour chaque cellule d'une ligne
        $j = 0;
        foreach($ligne as $cell) {
            //Si la case n'est pas vide elle appartient a un joueur
            if ($cell == $this->numJoueur) {
                $pts[] = [$j, $i];
            }
            $j++;
        }
        $i++;
    }

    foreach ($pts as $pt) {
      //Est-ce qu'un pion m'appartenant est a coté de mon $pt ?

      //À droite ?
      if ($pt[0] != 18 && $this->arr[$pt[1]][$pt[0] + 1] == $this->numJoueur) {
          if ($pt[0] + 1 != 18 && $this->arr[$pt[1]][$pt[0] + 2] == $this->numJoueur) {
              if ($pt[0] + 2 != 18 && $this->arr[$pt[1]][$pt[0] + 3] == $this->numJoueur) {
                  if ($pt[0] + 3 != 18 && $this->arr[$pt[1]][$pt[0] + 4] == $this->numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }

      //À gauche ?
      if ($pt[0] != 0 && $this->arr[$pt[1]][$pt[0] - 1] == $this->numJoueur) {
          if ($pt[0] - 1 != 0 && $this->arr[$pt[1]][$pt[0] - 2] == $this->numJoueur) {
              if ($pt[0] - 2 != 0 && $this->arr[$pt[1]][$pt[0] - 3] == $this->numJoueur) {
                  if ($pt[0] - 3 != 0 && $this->arr[$pt[1]][$pt[0] - 4] == $this->numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }

      //En bas ?
      if ($pt[1] != 18 && $this->arr[$pt[1] + 1][$pt[0]] == $this->numJoueur) {
          if ($pt[1] + 1 != 18 && $this->arr[$pt[1] + 2][$pt[0]] == $this->numJoueur) {
              if ($pt[1] + 2 != 18 && $this->arr[$pt[1] + 3][$pt[0]] == $this->numJoueur) {
                  if ($pt[1] + 3 != 18 && $this->arr[$pt[1] + 4][$pt[0]] == $this->numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }

      //En haut ?
      if ($pt[1] != 0 && $this->arr[$pt[1] - 1][$pt[0]] == $this->numJoueur) {
          if ($pt[1] -1 != 0 && $this->arr[$pt[1] - 2][$pt[0]] == $this->numJoueur) {
              if ($pt[1] -2 != 0 && $this->arr[$pt[1] - 3][$pt[0]] == $this->numJoueur) {
                  if ($pt[1] -3 != 0 && $this->arr[$pt[1] - 4][$pt[0]] == $this->numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }

      //Diago haut droite
      if ($pt[0] != 18 && $pt[1] != 0 && $this->arr[$pt[1] - 1][$pt[0] + 1] == $this->numJoueur) {
          if ($pt[0] + 1 != 18 && $pt[1] - 1 != 0 && $this->arr[$pt[1] - 2][$pt[0] + 2] == $this->numJoueur) {
              if ($pt[0] + 2 != 18 && $pt[1] - 2 != 0 && $this->arr[$pt[1] - 3][$pt[0] + 3] == $this->numJoueur) {
                  if ($pt[0] + 3 != 18 && $pt[1] - 3 != 0 && $this->arr[$pt[1] - 4][$pt[0] + 4] == $this->numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }


      //Diago haut gauche
      if ($pt[0] != 0 && $pt[1] != 0 && $this->arr[$pt[1] - 1][$pt[0] - 1] == $this->numJoueur) {
          if ($pt[0] - 1 != 0 && $pt[1] - 1 != 0 && $this->arr[$pt[1] - 2][$pt[0] - 2] == $this->numJoueur) {
              if ($pt[0] - 2 != 0 && $pt[1] - 2 != 0 && $this->arr[$pt[1] - 3][$pt[0] - 3] == $this->numJoueur) {
                  if ($pt[0] - 3 != 0 && $pt[1] - 3 != 0 && $this->arr[$pt[1] - 4][$pt[0] - 4] == $this->numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }

      //Diago bas droite
      if ($pt[0] != 18 && $pt[1] != 18 && $this->arr[$pt[1] + 1][$pt[0] + 1] == $this->numJoueur) {
          if ($pt[0] + 1 != 18 && $pt[1] + 1 != 18 && $this->arr[$pt[1] + 2][$pt[0] + 2] == $this->numJoueur) {
              if ($pt[0] + 2 != 18 && $pt[1] + 2 != 18 && $this->arr[$pt[1] + 3][$pt[0] + 3] == $this->numJoueur) {
                  if ($pt[0] + 3 != 18 && $pt[1] + 3 != 18 && $this->arr[$pt[1] + 4][$pt[0] + 4] == $this->numJoueur) {
                      $isWinner = true;
                      break;
                  }
              }
          }
      }

      //Diago bas gauche
      if ($pt[0] != 0 && $pt[1] != 18 && $this->arr[$pt[1] + 1][$pt[0] - 1] == $this->numJoueur) {
          if ($pt[0] - 1 != 0 && $pt[1] + 1 != 18 && $this->arr[$pt[1] + 2][$pt[0] - 2] == $this->numJoueur) {
              if ($pt[0] - 2 != 0 && $pt[1] + 2 != 18 && $this->arr[$pt[1] + 3][$pt[0] - 3] == $this->numJoueur) {
                  if ($pt[0] - 3 != 0 && $pt[1] + 3 != 18 && $this->arr[$pt[1] + 4][$pt[0] - 4] == $this->numJoueur) {
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

public function countTenailles() {
    /********************************************************************************/
    /***** Détermine la position des pions de chaque joueur [[0,0], [2,1], ...] *****/
    /********************************************************************************/

    $pts = [];
    $this->numJoueur = 1;
    $numEnnemi = ($this->numJoueur == 1 ? 2 : 1);

    //Pour chaque ligne
    $i = 0;
    foreach($this->arr as $ligne) {
        //Pour chaque cellule d'une ligne
        $j = 0;
        foreach($ligne as $cell) {
            //Si la case n'est pas vide elle appartient a un joueur
            if ($cell == $numEnnemi) {
                $pts[] = [$j, $i];
            }
            $j++;
        }
        $i++;
    }

    /********************************************************************************/
    /***** LA TENAILLE                                                          *****/
    /********************************************************************************/

    $tenailles = 0;

    foreach ($pts as $pt) {
        //Est-ce qu'un pion ennemi est a coté de mon $pt ? Est-ce qu'il y a un pion a moi a coté de moi ?
        
        //Pion allié à droite du pion ennemi ?
        if ($pt[0] != 18 && $this->arr[$pt[1]][$pt[0] + 1] == $this->numJoueur) {
            //Pion ennemi a gauche de pion ennemi ?
            if ($pt[0] != 0 && $this->arr[$pt[1]][$pt[0] - 1] == $numEnnemi) {
                //Pion allié a gauche du pion ennemi qui est a gauche du pion ennemi ? (c'est pas si compliqué, sisi !)
                if ($pt[0] - 1 != 0 && $this->arr[$pt[1]][$pt[0] - 2] == $this->numJoueur) {
                    //Est-ce que j'ai posé mon pion pour le tenailler ou est-ce qu'il s'est placé entre deux de mes pions ?
                    if ($this->arr[$pt[1]][$pt[0] + 1] != $prevArray[$pt[1]][$pt[0] + 1] || $this->arr[$pt[1]][$pt[0] - 2] != $prevArray[$pt[1]][$pt[0] - 2]) {
                        $tenailles++;
                        //Enlever les pions
                        $this->arr[$pt[1]][$pt[0]] = 0;
                        $this->arr[$pt[1]][$pt[0] - 1] = 0;
                    } 
                }
            }
        }
        

        //Pion allié en bas du pion ennemi ?
        if ($pt[1] != 18 && $this->arr[$pt[1] + 1][$pt[0]] == $this->numJoueur) {
            //Pion ennemi en haut du pion ennemi ?
            if ($pt[1] != 0 && $this->arr[$pt[1] - 1][$pt[0]] == $numEnnemi) {
                //Pion allié en haut du pion ennemi qui est en haut du pion ennemi ?
                if ($pt[1] - 1 != 0 && $this->arr[$pt[1] - 2][$pt[0]] == $this->numJoueur) {
                    //Est-ce que j'ai posé mon pion pour le tenailler ou est-ce qu'il s'est placé entre deux de mes pions ?
                    if ($this->arr[$pt[1] + 1][$pt[0]] != $prevArray[$pt[1] + 1][$pt[0]] || $this->arr[$pt[1] - 2][$pt[0]] != $prevArray[$pt[1] - 2][$pt[0]]) {
                        $tenailles++;
                        //Enlever les pions
                        $this->arr[$pt[1]][$pt[0]] = 0;
                        $this->arr[$pt[1] - 1][$pt[0]] = 0;
                    }
                }
            }
        }
        
        //Pion allié en diago haut droite du pion ennemi ?
        if ($pt[0] != 18 && $pt[1] != 0 && $this->arr[$pt[1] - 1][$pt[0] + 1] == $this->numJoueur) {
            //Pion ennemi en diago bas gauche ?
            if ($pt[0] != 0 && $pt[1] != 18 && $this->arr[$pt[1] + 1][$pt[0] - 1] == $numEnnemi) {
                //Pion allié en bas gauche du pion ennemi qui est en bas a gauche du pion ennemi ?
                if ($pt[0] - 1 != 0 && $pt[1] + 1 != 18 && $this->arr[$pt[1] + 2][$pt[0] - 2] == $this->numJoueur) {
                    //Est-ce que j'ai posé mon pion pour le tenailler ou est-ce qu'il s'est placé entre deux de mes pions ?
                    if ($this->arr[$pt[1] - 1][$pt[0] + 1] != $prevArray[$pt[1] - 1][$pt[0] + 1] || $this->arr[$pt[1] + 2][$pt[0] - 2] != $prevArray[$pt[1] + 2][$pt[0] - 2]) {
                        $tenailles++;
                        //Enlever les pions
                        $this->arr[$pt[1]][$pt[0]] = 0;
                        $this->arr[$pt[1] + 1][$pt[0] - 1] = 0;
                    }
                }
            } 
        }
        
        //Pion allié en diago haut gauche du pion ennemi ?
        if ($pt[0] != 0 && $pt[1] != 0 && $this->arr[$pt[1] - 1][$pt[0] - 1] == $this->numJoueur) {
            //Pion ennemi en diago bas droite ?
            if ($pt[0] != 18 && $pt[1] != 18 && $this->arr[$pt[1] + 1][$pt[0] + 1] == $numEnnemi) {
                //Pion allié en bas droite du pion ennemi qui est en bas a droite du pion ennemi ?
                if ($pt[0] + 1 != 18 && $pt[1] + 1 != 18 && $this->arr[$pt[1] + 2][$pt[0] + 2] == $this->numJoueur) {
                    //Est-ce que j'ai posé mon pion pour le tenailler ou est-ce qu'il s'est placé entre deux de mes pions ?
                    if ($this->arr[$pt[1] - 1][$pt[0] - 1] != $prevArray[$pt[1] - 1][$pt[0] - 1] || $this->arr[$pt[1] + 2][$pt[0] + 2] != $prevArray[$pt[1] + 2][$pt[0] + 2]) {
                        $tenailles++;
                        //Enlever les pions
                        $this->arr[$pt[1]][$pt[0]] = 0;
                        $this->arr[$pt[1] + 1][$pt[0] + 1] = 0;
                    }
                }
            } 
        }
    }
    return $tenailles;
  }
}
?>
