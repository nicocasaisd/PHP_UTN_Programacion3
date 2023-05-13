<?php

/* 
B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
*/

include_once './biblioteca.php';

$array = ReadJson();

//var_dump($array[0]);
//echo $array[0]->id;

if (
    ValidarEmpty('sabor', $_POST)
    && ValidarEmpty('tipo', $_POST)
    && ValidarNumeric('precio', $_POST)
    && ValidarNumeric('cantidad', $_POST)
) {
    $pizza = new Pizza($_POST['sabor'], $_POST['tipo'], $_POST['precio'], $_POST['cantidad']);
    $array = Pizza::AddPizza($array, $pizza);

}

//var_dump($array);

WriteJson($array);




