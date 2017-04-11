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
      $idJoueur = $request->url_elements[4];

      // TODO
      // stocker le dernier qui a joué :
       //$_SESSION["last_played"] = $idJoueur;

      // set dernier coup X dans $_SESSION["last_played_x"]
      // set dernier coup Y dans $_SESSION["last_played_y"]

      // on inverse le tour :
      if ($_SESSION["turn"] == 0) {
        $_SESSION["turn"] = 1;
      } else if ($_SESSION["turn"] == 1) {
        $_SESSION["turn"] = 0;
      }

      $data = array("code" => 200);
    }
    return $data;
  }
}

?>
