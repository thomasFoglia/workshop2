<?php

class ConnectController
{
  public function getAction($request) {
    $data = [];
    if (isset($request->url_elements[2]) && $request->url_elements[2] != '') {
      $joueurName = $request->url_elements[2];

      // TODO
      $idJoueur = 1;
      $nomJoueur = "toto";
      $numJoueur = 999;

      $data = array(
        "idJoueur" => $idJoueur,
        "code" => 200,
        "nomJoueur" => $nomJoueur,
        "numJoueur" => $numJoueur
      );
    }
    return $data;
  }
}

?>
