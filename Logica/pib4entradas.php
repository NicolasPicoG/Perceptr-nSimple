<?php
    require_once './neurona.php';

    function nextIndice($index) {
    if ($index >= 15) {
        return 0;
    } else {
        return ++$index;
    }

    }

    entrenarPib(2,2, 2, 2, 2, 1.3); 
  function entrenarPib($w1, $w2, $w3, $w4, $eR, $fA) {
      
    $retorno= null;
    $yR=0;

    $x1 = [419077, 444943, 472591 , 492507, 503416, 529002, 558993, 589694, 621266, 648134, 670201, 681101, 696973, 722941, 755975];
    $x2 = [86720, 101405, 117424, 128090, 120026, 131503, 155852, 160351, 172869, 193533 ,191305, 190994, 184828, 188643, 196673];
    $x3 = [88125, 96513, 102516, 104604, 99158, 101203, 113608, 118690, 124241, 123882, 125936 ,125673, 128902, 129998, 134072];
    $x4 = [78708, 92625, 105461, 118656, 108395, 120134, 144436, 157977, 171443, 184747, 182750, 176279, 178075, 188389, 205677];
    $yf = [514853, 549435, 586457, 605713, 612616, 640151, 684628, 711415, 747939, 781589, 804692, 821489, 832656, 853600, 881958];

    $iteracionR = 0;
    $iteracionT = 0;
    $indice = 0;
    $exitos = 0;
    $n = new Neurona($w1, $w2, $w3, $w4, $eR, $fA);

    // bucle de sumatoria
    for (;;) {

        $iteracionT++;
        echo "w1 = " . $n->w1 . " w2 = ". $n->w2 . " w3 = " . $n->w3. " w4 = ". $n->w4 . " iteración total= " . $iteracionT ." iteración reaprendizaje = " .$iteracionR . " indice = " .$indice."<br>";

        if ($iteracionT == 10000) {
           echo "Se sobrepasaron las 10000 iteraciones.."."<br>";
            break;
        }

        if ($exitos == 15) {
            echo "Exito completo con " . $n->toString()."<br>";
           
            break;
        }
            /*  System.out.println("x1 "+x1[indice]+"x2 "+x2[indice]+"EXITOS "+exitos);*/
        $yR = $n->funcionDePropagacion($x1[$indice], $x2[$indice], $x3[$indice], $x4[$indice]);
       $yR= $yR/1000000000;
       
       $yR=$yR/1000;
       $comparadorInferior = $yR - 30000;
       $comparadorSuperior = $yR + 30000;
         
        /*System.out.println(yf[indice] );
        
        System.out.println(yR);*/

        if ($yf[$indice] >= $comparadorInferior && $yf[$indice] <= $comparadorSuperior) {
            $exitos++;
            echo "exitos".$exitos;
            $indice = nextIndice($indice);
            continue;

        } else {
            $n->funcionDeReaprendizaje($yf[$indice], 1, $x1[$indice], $x2[$indice], $x3[$indice], $x4[$indice]);
            $exitos = 0;
            $iteracionR++;
        }


    }

   echo "w1 = " . $n->w1."<br>";
   echo "w2 = " . $n->w2."<br>";
   echo "w3 = " . $n->w3."<br>";
   echo "w4 = " . $n->w4."<br>";
   echo "eR = " . $n->eR."<br>";
   echo "fA = " . $n->fA."<br>";

    

    echo "Se realizaron " . $iteracionR. " iteraciones de re-aprendizajes"."<br>";
   echo "Se realizaron " . ($iteracionT - 1) . " iteraciones totales"."<br>";
    echo $n->toString()."<br>";

    return $retorno;
    
}


?>