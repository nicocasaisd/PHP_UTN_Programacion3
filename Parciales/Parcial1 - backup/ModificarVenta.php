<?php

/* 
6- (2 pts.) ModificarVenta.php(por PUT), debe recibir el número de pedido, el email del usuario, el sabor,tipo y
cantidad, si existe se modifica , de lo contrario informar.
*/


echo 'Modificar' . PHP_EOL;

include_once './biblioteca.php';
include_once './Pizza.php';
include_once './Venta.php';

$array_venta = ReadJson('./venta.json');

if (
    ValidarEmpty('sabor', $_PUT)
    && ValidarEmpty('tipo', $_PUT)
    && ValidarNumeric('cantidad', $_PUT)
    && ValidarNumeric('nro_de_pedido', $_PUT)
    && ValidarEmpty('mail', $_PUT)
) {

    $array_venta = Venta::ModificarVenta($array_venta, $_PUT);
}

WriteJson($array_venta, './venta.json');