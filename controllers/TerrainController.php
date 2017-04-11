<?php


class TerrainController

{
    // get one
    // or get all
    public function getAction($request) {
        $pdo = new bdd();
        // un id de terrain passé en paramètre
        if(isset($request->url_elements[2]) && $request->url_elements[2] != '') {
            // get id = $id_terrain
            $id_terrain = (int)$request->url_elements[2];
            // get in BDD
            $data = $pdo->select('SELECT * FROM terrain WHERE id = ' . $id_terrain);
            if (empty($data)){
                // http 404
                header("HTTP/1.1 404 Terrain Not Found");
                return [];
            }
            // http 200
            header("HTTP/1.1 200 Terrain Found");
            return $data;
        } else {
            // get all
            $data = $pdo->select('SELECT * FROM terrain');
            header("HTTP/1.1 200 OK");
        }
        
        return $data;
    }
    
    // delete
    public function deleteAction($request) {
        $parameters = $request->parameters;
        $pdo = new bdd();

        if(isset($parameters["id"]) && $parameters["id"] != '') {
            $id_terrain = $parameters["id"];
            // delete id = $id_terrain
            
            $terrain = $pdo->select('SELECT * FROM terrain where id ='.$id_terrain);
            /*On vérifie si l'id est bon*/
            if (!empty($terrain)){
                /*Check si une reservation existe sur le terrain qui va être supprimé*/
                $reservation = $pdo->select('SELECT * FROM reservation where id_terrain='.$id_terrain);
                if (empty($reservation)) {
                    $nb = $pdo->exec('DELETE FROM terrain WHERE id = ' . $id_terrain);
                    // http 200
                    header("HTTP/1.1 200 Sucessfully terrain deleted");
                } else {
                    // header 404
                    header("HTTP/1.1 404 Forbidden, there is a reservation");
                }
                return [];
            } else {
                // header 404
                header("HTTP/1.1 404 Terrain not found");
            }
            
            return [];
        } else {
            header("HTTP/1.1 404 id terrain not found");
            return [];
        }
    }
    
    // update
    public function putAction($request) {
        $parameters = $request->parameters;
        $pdo = new bdd();
         // parse parameters
        // id required !
        if(!isset($parameters["id"]) || $parameters["id"] == '' ) {
            header("HTTP/1.1 404 Missing Parameter Id");
            return [];
        } else {
            $id = $parameters["id"];
        }
        
        $my_terrain = $pdo->select('SELECT * FROM terrain where id='.$id.'');
        
        if (empty($my_terrain)) {
            header("HTTP/1.1 404 Terrain Not Found");
            return [];
        }
        
        if(!isset($parameters["available"]) || $parameters["available"] == '' ) {
            $available = $my_terrain[0]["available"];
        } else {
            $available = $parameters["available"];
        }


        $pdo->exec("UPDATE terrain SET available = $available WHERE id = $id");
        // get object terrain updated
        $obj = $pdo->select("SELECT * FROM terrain WHERE id = " . $id);
        
        // http 200
        header("HTTP/1.1 200 Sucessfully terrain updated");
        return $obj;
    }
    
    // create
    public function postAction($request) {
        $data = [];
        $parameters = $request->parameters;
        if(isset($request->parameters['available']) &&  $request->parameters['available'] != null) {
            // parse parameter available
            $available = $parameters["available"];

            $pdo = new bdd();
            $id_inserted = $pdo->create("INSERT INTO terrain (available) VALUES ($available)");

            // get object terrain inserted :
            $obj = $pdo->select("SELECT * FROM terrain WHERE id = " . $id_inserted);

            $data = $obj;
            // http 200
            header("HTTP/1.1 200 Terrain created");
            return $data;
        } else {
            header("HTTP/1.1 404 Missing Parameter Available");
            return [];
        }
    }
}

?>