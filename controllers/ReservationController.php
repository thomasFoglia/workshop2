<?php

class ReservationController
{
    // Récupérer l'action GET (cela affiche toutes les réservations si pas de paramètre)
    public function getAction($request) {
        
        $pdo = new bdd();
        /*Vérifier si un paramètre est présent*/
        if(isset($request->url_elements[2]) && $request->url_elements[2] != '') {
            // get id = $id_terrain
            $id_reservation = (int)$request->url_elements[2];
            // Requête BDD en fonction de l'id récupéré
            $data =  $pdo->select('SELECT * FROM reservation WHERE id = ' . $id_reservation);
            /*Vérifier si la requête retourne quelque chose*/
            if($data == []) {
               header("HTTP/1.1 404 Reservation Not Found"); 
            } else {
                header("HTTP/1.1 200 Reservation Found");
            }
        } else {
            // Si pas de paramètres renvoyer toutes les entités réservations
            $data =  $pdo->select('SELECT * FROM reservation');
            header("HTTP/1.1 200 Found");
        }
        return $data;
    }
    
    // Récupérer l'action DELETE
    public function deleteAction($request) {
        $parameters = $request->parameters;
        $pdo = new bdd();

        if(isset($parameters["id"]) && $parameters["id"] != '') {
            $id_reservation = $parameters["id"];
            // delete id = $id_terrain
            
            // Requête BDD en fonction de l'id récupéré (nb est le nombre de lignes affectées)
            $nb = $pdo->exec('DELETE FROM reservation WHERE id = ' . $id_reservation);
            

            if ($nb == 1){
                /*Si la supression a bien eu lieue*/
                header("HTTP/1.1 200 Sucessfully deleted");
            } else {
                /*Sinon*/
                header("HTTP/1.1 404 Reservation not found");
            }
            return [];
        } else {
            header("HTTP/1.1 404 id reservation not found");
            return [];
        }
    }
    
    // Récupérer l'action PUT
     public function putAction($request) {
        $parameters = $request->parameters;
        $pdo = new bdd();

        /*Vérifier si un paramètre id de la réservation est bien renseigné*/
        if (isset($parameters["id"]) && $parameters["id"] != '' ) {

            /*Récupérer l'id de la réservation*/
            $id = $parameters["id"];

            /*Récupérer l'entité réservation en fonction de l'id*/
            $my_resa = $pdo->select('SELECT * FROM reservation where id='.$id.'');
            
            if (!empty($my_resa)) {

                /*Vérifier si un paramètre heure_reservation de la réservation est bien renseigné*/
                if(isset($parameters["heure_reservation"]) && $parameters["heure_reservation"] != '' ) {
                    $heure = $parameters["heure_reservation"];
                } else {
                    /*Sinon la valeur de heure_reservation ne sera pas modifiée pour cette réservation*/
                    $heure = $my_resa[0]["heure_reservation"];
                }

                /*Vérifier si un paramètre id_terrain de la réservation est bien renseigné*/
                if(isset($parameters["id_terrain"]) && $parameters["id_terrain"] != '') {
                     $terrainId = $parameters["id_terrain"];
                } else {
                    /*Sinon la valeur de id_terrain ne sera pas modifiée pour cette réservation*/
                    $terrainId = $my_resa[0]["id_terrain"];
                }  


                $heure = strtotime($heure);
                $heure = date('Y-m-d H',$heure);
                // Check si heure valide selon le schéma Année-mois-jour Heure
                if ($this->validateDate($heure)) {
                    /*Vérifier si changement possible (date pour un terrain pas déjà prise)*/
                    $exist = $pdo->select('SELECT * FROM reservation where id_terrain= '.$terrainId.' and heure_reservation = "'.$heure.'"');
                    if(empty($exist)) {
                        /*Requête pour modification*/
                        $pdo->exec("UPDATE reservation SET id_terrain = $terrainId ,heure_reservation = '$heure'  WHERE id = $id");
                        /*Récupérer la réservation modifiée*/
                        $obj = $pdo->select("SELECT * FROM reservation WHERE id = " .$id);
                        $data = $obj;
                        header("HTTP/1.1 200 Sucessfully updated");
                    } else {
                        /*Message d'erreur si réservation déjà prise pour un terrain à une telle heure*/
                        $data = [];
                        header("HTTP/1.1 404 Terrain is already taken ");
                    }
                } else {
                    /*Message d'erreur si la date n'est pas dans le bon format*/
                    $data = [];
                     header("HTTP/1.1 404 Bad Parameter Date");
                }

            } else {
              $data = [];
              header("HTTP/1.1 404 Reservation not found"); 
            } 
        } else {
            $data = [];
            header("HTTP/1.1 404 Reservation id not found");
        }
        return $data;
    }
    
    // Récupérer l'action POST
    public function postAction($request) {
        $pdo = new bdd();
        
        /*Vérifier si une heure de réservation est bien renseignée*/
        if(isset($request->parameters['heure_reservation']) &&  $request->parameters['heure_reservation'] != null) {

            // Check i heure valide selon le schéma Année-mois-jour Heure
            $data = strtotime($request->parameters['heure_reservation']);
            $data = date('Y-m-d H',$data);

            /*Récupérer la date du jour et tronquer la date reçu à l'heure (On ne peut réserver que à l'heure)*/
            $dateCompare = new DateTime($data.":00:00");
            $now = new DateTime("now");
            
            if ($this->validateDate($data)) {
                /*Vérifier si l'heure de réservation n'est pas antérieure à la date du jour */
                if ($dateCompare > $now) {
                    // Vérifier si un terrain est disponible à cette heure
                    $terrain_libre = $pdo->select('SELECT * FROM terrain t WHERE t.available = 1 and NOT EXISTS( SELECT t.id FROM reservation r WHERE  t.id = r.id_terrain AND r.heure_reservation = "'.$data.'")');
                    
                    
                    if (!empty($terrain_libre)) {
                        $terrainId = $terrain_libre[0]["id"];
                        $lastId = $pdo->create("INSERT INTO reservation (heure_reservation,id_terrain) values('$data',$terrainId)");
                        $my_resa = $pdo->select('SELECT * FROM reservation WHERE id = '.$lastId);
                        $data = $my_resa;
                        header("HTTP/1.1 200 Sucessfully created");
                    } else {
                        $data = [];
                        header("HTTP/1.1 404 No Terrains Available");
                    }
                } else {
                    $data = [];
                    header("HTTP/1.1 404 Past Date");
                }
            } else {
                 $data = [];
                 header("HTTP/1.1 404 Bad Parameter Date");
            }

        } else {
            $data = [];
            header("HTTP/1.1 404 No Date Input");
        }
        // parse parameters
        return $data;
    }

    
    /*Fonction pour valider le format de date*/
    public function validateDate($date, $format = 'Y-m-d H')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }   
}

?>
