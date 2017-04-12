<?php
class IaController
{
    public function postAction($request) {
    	if( isset($_POST['currentGrid']) ){
      		$currentGrid = $_POST['currentGrid'];
      		//$currentGrid = unserialize($currentGrid);
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
			$randomChoice = array_rand($tabEmpty);
			$data = json_encode($tabEmpty[$randomChoice]);
			
	      	header("HTTP/1.1 200 OK");
	      echo $data;
  		}
      	$data = [];
      	if(isset($request->url_elements[2]) && $request->url_elements[2]  != '') {
	        $data = $request->url_elements[2];

    	}
	}
}

?>
