<?php

require '../Logica/perceptorsimple.php';

$and = array();
//Valores Iniciales
$tetha = -0.4;
$e = 0.6;
$w1 = 1.2;
$w2 = 1.2;


//Respuesta
$respuesta = '';

$perceptor = new PerceptorSimple($w1, $w2, $e, $tetha);


if (isset($_POST['BtnAprender'])) {

    $validar = $perceptor->Aprender();


    if ($validar) {



        $display = "";
        $display2 = "display:none;";

        echo 'Si se encontro Solución con los Parametros';
        echo 'W1:' . $perceptor->w1 . ' W2:' . $perceptor->w2 . ' Tetha:' . $perceptor->tetha . ' e:' . $perceptor->e;
    } else {
        $display2 = "";
        $display = "display:none;";
        echo 'No se encontro solucion para W1:' . $w1 . ' W2:' . $w2 . ' Tetha:' . $tetha . ' e:' . $e;
    }
}

if (isset($_POST['BtnCalcular'])) {
    $i = 0;

    $validar = $perceptor->Aprender();

    $and = $perceptor->andc;



    //if ($and[$i][0] == $_POST['x1'] and  $and[$i][1] == $_POST['x2']) {


    $respuesta = $y = tanh($w1 * $_POST['x1'] + $w2 * $_POST['x2'] - ($tetha));


    $i++;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Perceptor Simple</title>

</head>

<body>

    <div class="container ">

        <form action="2Entradas.php" method="POST">
            <h1 class="text-center">Perceptor Simple</h1>
            <div class="container-md p-3">
                <div class="row justify-content-md-center ">

                    <div class="col-sm-2 offset-sm-1">
                        <div class="column justify-content-md-center">
                            <label>X1</label>
                            <input type="text" value="<?php if (isset($_POST['x1'])) {
                                                            echo $_POST['x1'];
                                                        } ?>" name="x1">
                        </div>
                    </div>

                    <div class="col-sm-2 offset-sm-1">
                        <div class="column justify-content-md-center">
                            <label>X2</label>
                            <input type="text" value="<?php if (isset($_POST['x2'])) {
                                                            echo $_POST['x2'];
                                                        } ?>" name="x2">
                        </div>
                    </div>

                    <div class="col-sm-2 offset-sm-1">
                        <div class="column justify-content-md-center">
                            <label>Respuesta</label>
                            <input type="text" name="and" value="<?= $respuesta ?>">
                        </div>
                    </div>

                </div>


                <div class="row justify-content-md-center p-4">
                    <input type="submit" styles="<?= $display2; ?>" name="BtnAprender" value="Aprender" class="btn btn-success mr-2">


                    <input type="submit" styles="<?= $display; ?>" name="BtnCalcular" value="Calcular" class="btn btn-success mr-2">
                </div>


            </div>
        </form>

    </div>

</body>

</html>