<?php

class TurnController
{
    public function getAction($request) {
      $data = [];
      if(isset($request->url_elements[2]) && $request->url_elements[2] != '') {
        $data = $request->url_elements[2];
      }
      header("HTTP/1.1 200 OK");
      return $data;
      }
}

?>
