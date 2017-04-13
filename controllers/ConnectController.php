<?php
class ConnectController
{
  public function getAction($request) {
    $_SESSION['tableau'] = $this->initTableau();

    $data = [];
    if (isset($request->url_elements[2]) && $request->url_elements[2] != '') {
      $nomJoueur = $request->url_elements[2];
      
      //joueur 1 se connecte
      if (empty($_SESSION["j1"])) {
        $idJoueur = md5(uniqid());
        $code = 200;
        $numJoueur = 1;
        $nbTenailles = 0;

        $_SESSION["j1"] = array("nomJoueur" => $nomJoueur, "idJoueur" => $idJoueur, "numJoueur" => $numJoueur, "nbTenailles" => $nbTenailles);
        // joueur 2 se connecte
      } else if (empty($_SESSION["j2"])) {
        $idJoueur = md5(uniqid());
        $code = 200;
        $numJoueur = 2;
        $nbTenailles = 0;
        
        $_SESSION["j2"] = array("nomJoueur" => $nomJoueur, "idJoueur" => $idJoueur, "numJoueur" => $numJoueur, "nbTenailles" => $nbTenailles);

        //La partie commence 
        $_SESSION["turn"] = rand(0, 1);
        $_SESSION["prolongation"] = false;
        $_SESSION["gameEnded"] = false;
        $_SESSION["detailsGameEnd"] = "hehueuheuheuheuheuheuhuheuheuheeuhueh";
        $_SESSION["numTour"] = 0;
        $_SESSION["lastPlayed"] = null;

      } else {
        //Partie full
        return array("nomJoueur" => null, "code" => 401, "idJoueur" => null, "numJoueur" => null, "nbTenailles" => null);
      }

      return array(
        "idJoueur" => $idJoueur,
        "code" => $code,
        "nomJoueur" => $nomJoueur,
        "numJoueur" => $numJoueur,
        "nbTenailles" => $nbTenailles
      );
    }
  }

  // retourne un tableau de 19x19 initialisé à 0
  public function initTableau() {
    $arr = [];
    for ($i = 0 ; $i < 20 ; $i ++) {
      $tmp = [];
      for ($p = 0 ; $p < 20 ; $p ++) {
        $tmp[] = 0;
      }
      $arr[] = $tmp;
    }
    return $arr;
  }
}
?>
