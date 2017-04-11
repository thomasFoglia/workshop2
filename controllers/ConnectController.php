<?php

class ConnectController
{
  public function getAction($request) {
    $data = [];
    if (isset($request->url_elements[2]) && $request->url_elements[2] != '') {
      $nomJoueur = $request->url_elements[2];

      //joueur 1 se connecte
      if (!isset($_SESSION["j1"])) {
        $idJoueur = md5(uniqid());
        $code = 200;
        $numJoueur = 1;
        $_SESSION["j1"] = array("nomJoueur" => $nomJoueur, "idJoueur" => $idJoueur, "numJoueur" => $numJoueur);
        // joueur 2 se connecte
      } else if (!isset($_SESSION["j2"])) {
        $idJoueur = md5(uniqid());
        $code = 200;
        $numJoueur = 2;
        $_SESSION["j2"] = array("nomJoueur" => $nomJoueur, "idJoueur" => $idJoueur, "numJoueur" => $numJoueur);
      } else {
        // deja connecté
        $datasUser = $this->getInfosFromSession($nomJoueur);
        return $datasUser;
        $idJoueur = $datasUser["idJoueur"];
        $code = 401;
        $nomJoueur = $datasUser["nomJoueur"];
        $numJoueur = $datasUser["numJoueur"];
      }

      return array(
        "idJoueur" => $idJoueur,
        "code" => $code,
        "nomJoueur" => $nomJoueur,
        "numJoueur" => $numJoueur
      );
    }
  }

  // retourne les infos de l'utilisateur recherché par son nom
  public function getInfosFromSession($nomJoueur) {
    for ($nb_users = 2; $nb_users > 0; $nb_users --) {
      if (isset($_SESSION["j" . $nb_users])) {
        if ($_SESSION["j" . $nb_users]["nomJoueur"] == $nomJoueur) {
          $idJoueur = $_SESSION["j" . $nb_users]["idJoueur"];
          $numJoueur = $_SESSION["j" . $nb_users]["numJoueur"];
          return array("nomJoueur" => $nomJoueur, "code" => 401, "idJoueur" => $idJoueur, "numJoueur" => $numJoueur);
        }
      }
    }
    return array("nomJoueur" => null, "code" => 401, "idJoueur" => null, "numJoueur" => null);
  }

}
?>
