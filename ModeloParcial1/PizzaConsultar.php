<?php
/* 
(1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.
*/
include_once './biblioteca.php';

$array = ReadJson();

if (
    ValidarEmpty('sabor', $_GET)
    && ValidarEmpty('tipo', $_GET)
) {
    var_dump(Pizza::GetPizza($array, $_GET['sabor'], $_GET['tipo']));
}
else{
    echo 'Request invalida. No existen las keys' . PHP_EOL;
}
