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

      $data = array("code" => 200);
    }
    return $data;
  }
}

?>
