<?php

include_once './biblioteca.php';
include_once './Hamburguesa.php';
include_once './Venta.php';

$array = ReadJson('./hamburguesa.json');

//var_dump($array[0]);
//echo $array[0]->id;

if (
    ValidarEmpty('nombre', $_POST)
    && ValidarEmpty('tipo', $_POST)
    && ValidarEmpty('aderezo', $_POST)
    && ValidarNumeric('precio', $_POST)
    && ValidarNumeric('cantidad', $_POST)
) {
    $hamburguesa = new Hamburguesa($_POST['nombre'], $_POST['precio'], $_POST['tipo'],  $_POST['aderezo'], $_POST['cantidad']);
    $array = Hamburguesa::Add($array, $hamburguesa);

    Hamburguesa::GuardarImagen($_POST['tipo'] . $_POST['nombre']);

}

//var_dump($array);

WriteJson($array, './hamburguesa.json');




