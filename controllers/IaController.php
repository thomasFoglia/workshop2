<?php

class IaController
{
    public function getAction($request) {
    	if( isset($_POST['currentGrid']) ){
      $currentGrid = $_POST['currentGrid'];
  	}
      $data = [];
      if(isset($request->url_elements[2]) && $request->url_elements[2] != '') {
        $data = $request->url_elements[2];

        $tabEmpty = [];
		foreach ($currentGrid as $key=>$line){
			foreach($line as $sskey => $element){			
				switch ($element) {
				    case 0:
						$tabEmpty[] = ['x' => $sskey , 'y' => $key]; 
				    case 1:
				        $tabJoueur1[] = ['x' => $sskey , 'y' => $key]; 
				    case 2:
				        $tabJoueur2[] = ['x' => $sskey , 'y' => $key]; 
				}
			}
		}
		$randomChoice = array_rand($tabVide);
		$data = json_encode($tabVide[$randomChoice]);
      header("HTTP/1.1 200 OK");
      return $data;
    }
}

?>