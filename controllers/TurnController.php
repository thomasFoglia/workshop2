<?php
class TurnController
{
  public function getAction($request) {
    if (isset($request->url_elements[2]) && $request->url_elements[2] != '') {
      $nomJoueur = $request->url_elements[2];

      if (!empty($_SESSION["j1"]["nomJoueur"]) && !empty($_SESSION["j2"]["nomJoueur"])) {
        if ($_SESSION["j1"]["nomJoueur"] == $nomJoueur) {
            if ($_SESSION["turn"] == "0") {
              $status = 1;
            }
            else {
              $status = 0;
            }
        }
        else if ($_SESSION["j2"]["nomJoueur"] == $nomJoueur) {
          if ($_SESSION["turn"] == "1") {
            $status = 0;
          }
        }
      } else {
        $status = 0;
      }


      $tableau = $_SESSION['tableau']; // tableau
      $nbTenaillesJ1 = !empty($_SESSION["j1"]["nbTenailles"]) ? $_SESSION["j1"]["nbTenailles"] : 0;
      $nbTenaillesJ2 = !empty($_SESSION["j2"]["nbTenailles"]) ? $_SESSION["j2"]["nbTenailles"] : 0;
      $dernierCoupX = !empty($_SESSION["lastX"]) ? $_SESSION["lastX"] : -1;
      $dernierCoupY = !empty($_SESSION["lastY"]) ? $_SESSION["lastY"] : -1;
      $prolongation = $_SESSION["prolongation"];
      $finPartie = $_SESSION["gameEnded"];
      $detailFinPartie = "";
      $numTour = $_SESSION["numTour"];
      $code = 200;

      return array(
        "status" => $status,
        "tableau" => $tableau,
        "nbTenaillesJ1" => $nbTenaillesJ1,
        "nbTenaillesJ2" => $nbTenaillesJ2,
        "dernierCoupX" => $dernierCoupX,
        "dernierCoupY" => $dernierCoupY,
        "prolongation" => $prolongation,
        "finPartie" => $finPartie,
        "detailFinPartie" => $detailFinPartie,
        "numTour" => $numTour,
        "code" => $code
      );
    }
    return false;
  }

}
?>
