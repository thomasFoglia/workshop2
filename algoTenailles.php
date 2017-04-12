<?php
$arr = [
//  0   1  2  3  4  5  6  7  8  9 10 11  12 13 14 15 16 17 18 
    [1, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//0
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//1
    [0, 1, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//2
    [0, 1, 1, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//3
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//4
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//5
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//6
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//7
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//8
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//9
    [0, 0, 0, 0, 0, 0, 0, 0, 2, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//10
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//11
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//12
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//13
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//14
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//15
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//16
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0],//17
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 , 0, 0, 0, 0, 0, 0, 0]//18
];


/********************************************************************************/
/***** Détermine la position des pions de chaque joueur [[0,0], [2,1], ...] *****/
/********************************************************************************/

$ptsJ1 = [];
$ptsJ2 = [];

//Pour chaque ligne
$i = 0;
foreach($arr as $ligne) {
    //Pour chaque cellule d'une ligne
    $j = 0;
    foreach($ligne as $cell) {
        //Si la case n'est pas vide elle appartient a un joueur
        if ($cell == 1) {
            $ptsJ1[] = [$j, $i];
        }

        if ($cell == 2) {
            $ptsJ2[] = [$j, $i];
        }

        $j++;
    }
    $i++;
}

echo print_r($ptsJ1) . "<br/><br/>//<br/>";
echo print_r($ptsJ2);
echo "<br/><br/>/////////////<br/><br/>";

/********************************************************************************/
/***** Détermine les pions suceptibles d'etre en tenaille                   *****/
/********************************************************************************/

$ptsTJ1 = [];
$ptsTJ2 = [];

//Joueur 1
foreach ($ptsJ1 as $pt) {
    //Est-ce qu'un pion m'appartenant est a coté de mon $pt ?
    
    if ($pt[0] != 18) {
        //À droite ?
        if ($arr[$pt[1]][$pt[0] + 1] == 1) {
            $ptsTJ1[] = [$pt[0], $pt[1]];
            continue;
        }
    }
    if ($pt[0] != 0) {
        //À gauche ?
        if ($arr[$pt[1]][$pt[0] - 1] == 1) {
            $ptsTJ1[] = [$pt[0], $pt[1]];
            continue;
        }
    }

    if ($pt[1] != 18) {
        //En bas ?
        if ($arr[$pt[1] + 1][$pt[0]] == 1) {
            $ptsTJ1[] = [$pt[0], $pt[1]];
            continue;
        }
    }

    if ($pt[1] != 0) {
        //En haut ?
        if ($arr[$pt[1] - 1][$pt[0]] == 1) {
            $ptsTJ1[] = [$pt[0], $pt[1]];
            continue;
        }
    }

    if ($pt[0] != 18 && $pt[1] != 0) {
        //Diago haut droite
        if ($arr[$pt[1] - 1][$pt[0] + 1]) {
            $ptsTJ1[] = [$pt[0], $pt[1]];
        }
    }

    if ($pt[0] != 0 && $pt[1] != 0) {
        //Diago haut gauche
        if ($arr[$pt[1] - 1][$pt[0] - 1]) {
            $ptsTJ1[] = [$pt[0], $pt[1]];
        }
    }

    if ($pt[0] != 18 && $pt[1] != 18) {
        //Diago bas droite
        if ($arr[$pt[1] + 1][$pt[0] + 1]) {
            $ptsTJ1[] = [$pt[0], $pt[1]];
        }
    }

    if ($pt[0] != 0 && $pt[1] != 18) {
        //Diago bas gauche
        if ($arr[$pt[1] + 1][$pt[0] - 1]) {
            $ptsTJ1[] = [$pt[0], $pt[1]];
        }
    }
}

//Joueur 2
foreach ($ptsJ2 as $pt) {
    //Est-ce qu'un pion m'appartenant est a coté de mon $pt ?
    
    if ($pt[0] != 18) {
        //À droite ?
        if ($arr[$pt[1]][$pt[0] + 1] == 1) {
            $ptsTJ2[] = [$pt[0], $pt[1]];
            continue;
        }
    }
    if ($pt[0] != 0) {
        //À gauche ?
        if ($arr[$pt[1]][$pt[0] - 1] == 1) {
            $ptsTJ2[] = [$pt[0], $pt[1]];
            continue;
        }
    }

    if ($pt[1] != 18) {
        //En bas ?
        if ($arr[$pt[1] + 1][$pt[0]] == 1) {
            $ptsTJ2[] = [$pt[0], $pt[1]];
            continue;
        }
    }

    if ($pt[1] != 0) {
        //En haut ?
        if ($arr[$pt[1] - 1][$pt[0]] == 1) {
            $ptsTJ2[] = [$pt[0], $pt[1]];
            continue;
        }
    }

    if ($pt[0] != 18 && $pt[1] != 0) {
        //Diago haut droite
        if ($arr[$pt[1] - 1][$pt[0] + 1]) {
            $ptsTJ2[] = [$pt[0], $pt[1]];
        }
    }

    if ($pt[0] != 0 && $pt[1] != 0) {
        //Diago haut gauche
        if ($arr[$pt[1] - 1][$pt[0] - 1]) {
            $ptsTJ2[] = [$pt[0], $pt[1]];
        }
    }

    if ($pt[0] != 18 && $pt[1] != 18) {
        //Diago bas droite
        if ($arr[$pt[1] + 1][$pt[0] + 1]) {
            $ptsTJ2[] = [$pt[0], $pt[1]];
        }
    }

    if ($pt[0] != 0 && $pt[1] != 18) {
        //Diago bas gauche
        if ($arr[$pt[1] + 1][$pt[0] - 1]) {
            $ptsTJ2[] = [$pt[0], $pt[1]];
        }
    }
}

echo print_r($ptsTJ1) . "<br/><br/>//<br/>";
echo print_r($ptsTJ2);
?>