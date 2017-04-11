<?php
session_start();

class TurnController
{
  public function getAction($request) {
    if (isset($request->url_elements[2]) && $request->url_elements[2] != '') {
      $idJoueur = $request->url_elements[2];

      // POUR LE DEBUG
      $_SESSION["last_played"] = $idJoueur;
      $_SESSION["last_played_x"] = 10;
      $_SESSION["last_played_x"] = 12;


      if ($_SESSION["j1"]["idJoueur"] == $idJoueur) {
        if ($_SESSION["turn"] == "0") {
          $to_play = 1;
        }
      } else if ($_SESSION["j2"]["idJoueur"] == $idJoueur) {
        if ($_SESSION["turn"] == "1") {
          $to_play = 0;
        }
      }

      $status = $to_play;
      $datas = $_SESSION['datas']; // all datas
      $nbTenaillesJ1 = $this->getTenailles(1);
      $nbTenaillesJ2 = $this->getTenailles(2);
      $dernierCoupX = $_SESSION["last_played_x"];
      $dernierCoupY = $_SESSION["last_played_y"];
      $prolongation = false;
      $finPartie = false;
      $detailFinPartie = "";
      $numTour = 0;
      $code = 200;

      return array(
        "status" => $status,
        "tableau" => $datas,
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

  public function getTenailles($j) {

  }

}
?>
