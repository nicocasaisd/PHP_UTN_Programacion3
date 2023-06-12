<?php

include_once './biblioteca.php';
include_once './Hamburguesa.php';
include_once './Venta.php';

$array = ReadJson('./hamburguesa.json');

if (
    ValidarEmpty('nombre', $_GET)
    && ValidarEmpty('tipo', $_GET)
) {
    //var_dump(Hamburguesa::Get($array, $_GET['nombre'], $_GET['tipo']));
    if(Hamburguesa::Get($array, $_GET['nombre'], $_GET['tipo']) != "")
    {
        echo "Si hay" . PHP_EOL;
    }
    else
    {
        echo "No se encontro hamburguesa con esos keys." . PHP_EOL;
    }
}
else{
    echo 'Request invalida. No existen las keys' . PHP_EOL;
}
