<?php
class IaController
{
    public function postAction($request) {
    	if( isset($_POST['currentGrid']) ) {
        $currentGrid = $_POST['currentGrid'];
        $turn = $_POST['turn'];
        //$currentGrid = unserialize($currentGrid);
        $tabEmpty = [];
        if($turn ==1){
          return ['x'=>9,'y'=>9];
        }
        foreach ($currentGrid as $key=>$line) {
          foreach($line as $sskey => $element) {
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
        //$data = json_encode($tabEmpty[$randomChoice]);
        $data = $tabEmpty[$randomChoice];
        return $data;
        //echo $data;
      }
	}
}

?>
