<?php

/* 
6- (2 pts.) ModificarVenta.php(por PUT), debe recibir el número de pedido, el email del usuario, el nombre,tipo y
cantidad, si existe se modifica , de lo contrario informar.
*/


echo 'Modificar' . PHP_EOL;

include_once '../models/biblioteca.php';
include_once '../models/Hamburguesa.php';
include_once '../models/Venta.php';

$array_venta = ReadJson('./venta.json');

if (
    ValidarEmpty('nombre', $_PUT)
    && ValidarEmpty('tipo', $_PUT)
    && ValidarEmpty('aderezo', $_PUT)
    && ValidarNumeric('cantidad', $_PUT)
    && ValidarNumeric('nro_de_pedido', $_PUT)
    && ValidarEmpty('mail', $_PUT)
) {

    $array_venta = Venta::ModificarVenta($array_venta, $_PUT);
}

WriteJson($array_venta, './venta.json');