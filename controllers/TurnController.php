<?php

class TurnController
{
  public function getAction($request) {
    $data = [];
    if (isset($request->url_elements[2]) && $request->url_elements[2] != '') {
      $idJoueur = $request->url_elements[2];

      // TODO
      $status = 0;
      $tableau = array(); // clés ?
      $nbTenaillesJ1 = 5;
      $nbTenaillesJ2 = 9;
      $dernierCoupX = 1;
      $dernierCoupY = 12;
      $prolongation = false;
      $finPartie = false;
      $detailFinPartie = "texte";
      $numTour = 12;
      $code = 200;

      $data = array(
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
    return $data;
  }
}

?>
