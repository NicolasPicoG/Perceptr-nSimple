<?php

class Neurona{
    public $x1;
    public $x2;
    public $x3; 
    public $x4;
    public $w1;
    public $w2;
    public $w3;
    public $w4;
    public $eR;
    public $fA;
    public $yR;
    function __construct($w1,$w2,$w3,$w4,$eR,$fA)
    {
        $this->w1 = $w1;
        $this->w2 = $w2;
        $this->w3 = $w3;
        $this->w4 = $w4;
        $this->eR = $eR;
        $this->fA = $fA;
    }
    
    public function funcionDePropagacion($x1, $x2, $x3, $x4) {
       
        $wx = $x1 * $this->w1 + $x2 * $this->w2 + $x3 * $this->w3 - $x4 * $this->w4 - $this->eR; // Función propagación
        $this->yR = $wx;// Math.tanh(wx); // Salida
        return $this->yR;

    }

    public function verResultadoDePib($x1, $x2, $x3, $x4) {
        $res = $this->funcionDePropagacion($x1, $x2, $x3, $x4);
        $res=$res/1000000000;
        $res=$res/1000;
        
        return $res;

    }

    public function funcionDeReaprendizaje($yE, $yR, $x1, $x2, $x3, $x4) {

         $nw1=0; 
         $nw2=0; 
         $nw3=0; 
         $nw4=0; 
         $neR=0;
        $DY = ($yE - $yR);
        $Dx1 = $this->fA * $DY * $x1;
        $Dx2 = $this->fA * $DY * $x2;
        $Dx3 = $this->fA * $DY * $x3;
        $Dx4 = $this->fA * $DY * $x4;

        $nw1 = $this->w1 + $Dx1;
        $nw2 = $this->w2 + $Dx2;
        $nw3 = $this->w3 + $Dx3;
        $nw4 = $this->w4 + $Dx4;
        $neR = $this->eR - ($this->fA * $DY);

        $this->w1 = $nw1;
        $this->w2 = $nw2;
        $this->w3 = $nw3;
        $this->w4 = $nw4;
        $this->eR = $neR;

    }
    public function toString() {
        return "Neurona{" . "w1=". $this->w1 . ", w2=" . $this->w2 . ", w3=" . $this->w3 . ", w4=" . $this->w4 . ", eR=" . $this->eR . ", fA=" . $this->fA . ", yR=" . $this->yR . '}'."<br>";
    }   


}



?>