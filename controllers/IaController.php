<?php

class IaController
{
    public function getAction($request,$current_grid) {
      $data = [];
      if(isset($request->url_elements[2]) && $request->url_elements[2] != '') {
        $data = $request->url_elements[2];


        $tabresult = [];
		foreach ($current_grid as $key=>$line){
			foreach($line as $sskey => $element){			
				if ($element == 0){
					$tabresult[] = ['x' => $sskey , 'y' => $key];
				}
			}
		}
		$randomChoice = array_rand($tabresult);
		$data = json_encode($tabresult[$randomChoice]);
      header("HTTP/1.1 200 OK");
      return $data;
    }
}

?>