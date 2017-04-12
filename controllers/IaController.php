<?php
class IaController
{
    public function postAction($request) {
		$data = "penis";
    	if( isset($_POST['currentGrid']) ){
      		$currentGrid = $_POST['currentGrid'];
  		 $data ="current grid passe bien";
  		}
  		else{
  			$data = "on recoit pas le post";
  		}
      //	$data = [];
      	if(isset($request->url_elements[2]) && $request->url_elements[2] != '') {
	       // $data = $request->url_elements[2];
	        $tabEmpty = [];
			foreach ($currentGrid as $key=>$line){
				foreach($line as $sskey => $element){
					switch ($element) {
					    case 0:
							$tabEmpty[] = ['x' => $sskey , 'y' => $key];
							break;
					    case 1:
					        $tabJoueur1[] = ['x' => $sskey , 'y' => $key];
					        break;
					    case 2:
					        $tabJoueur2[] = ['x' => $sskey , 'y' => $key];
					        break;
					}
				}
			}
			$randomChoice = array_rand($tabEmpty);
			//$data = json_encode($tabEmpty[$randomChoice]);
	      	header("HTTP/1.1 200 OK");
	      return $data;
    	}
	}
}

?>
