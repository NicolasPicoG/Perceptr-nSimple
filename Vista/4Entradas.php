<?php

require '../Logica/perceptor4entradas.php';

$and = array();
//Valores Iniciales -2 y 2
$tetha = 0.7;
$e = 0.6;
$w1 = 6.63;
$w2 = 3.17;
$w3 = 0.8;
$w4 = 2.63;

//Respuesta
$respuesta = '';

$perceptor = new Perceptor4Entradas ($w1, $w2, $w3, $w4, $e, $tetha);

echo '<script type="text/javascript">alert("Los valores iniciales son W1: ' . $perceptor->w1 . ' W2: ' . $perceptor->w2 . ' W3: ' . $perceptor->w3 . ' W4: ' . $perceptor->w4 . ' Tetha: ' . $perceptor->tetha . ' e: ' . $perceptor->e . '");</script>';

if (isset($_POST['BtnCalcular4'])) {
    $i = 0;

    $validar = $perceptor->Aprender();

    $and = $perceptor->andc;

    //if ($and[$i][0] == $_POST['x1'] and  $and[$i][1] == $_POST['x2']) {

    $respuesta = $y = tanh($w1 * $_POST['x1'] + $w2 * $_POST['x2'] + $w3 * $_POST['x3'] + $w4 * $_POST['x4'] - ($tetha));

    if ($respuesta >= 0) {


        echo '<h3>La respuesta es 1</h3>';

    } else {

        echo '<h3>La respuesta es -1</h3>';

    } 


    $i++;
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Perceptor 4 Entradas</title>

</head>

<body>

    <div class="container ">

        <form action="4Entradas.php" method="POST">
            <h1 class="text-center">Perceptor 4 Entradas</h1>
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
                            <label>X3</label>
                            <input type="text" value="<?php if (isset($_POST['x3'])) {
                                                            echo $_POST['x3'];
                                                        } ?>" name="x3">
                        </div>
                    </div>

                    <div class="col-sm-2 offset-sm-1">
                        <div class="column justify-content-md-center">
                            <label>X4</label>
                            <input type="text" value="<?php if (isset($_POST['x4'])) {
                                                            echo $_POST['x4'];
                                                        } ?>" name="x4">
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
                  
                    <input type="submit" styles="<?= $display; ?>" name="BtnCalcular4" value="Calcular" class="btn btn-success mr-2">
                </div>


            </div>
        </form>

    </div>

</body>

</html>