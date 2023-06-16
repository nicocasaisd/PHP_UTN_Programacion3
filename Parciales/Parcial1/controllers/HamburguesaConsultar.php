<?php

include_once './models/biblioteca.php';
include_once './models/Hamburguesa.php';
include_once './models/Venta.php';

$array = ReadJson('./hamburguesa.json');

if (
    ValidarEmpty('nombre', $_POST)
    && ValidarEmpty('tipo', $_POST)
) {
    //var_dump(Hamburguesa::Get($array, $_POST['nombre'], $_POST['tipo']));
    if(Hamburguesa::Get($array, $_POST['nombre'], $_POST['tipo']) != "")
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
