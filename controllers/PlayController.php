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
        echo "tu pues la chiasse";
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
      //Else { la matrice explose le serveur brule de milles feux starf }
      
      //Place le point
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

  private function countTenailles($arr) {
    
    
  }
}

?>
