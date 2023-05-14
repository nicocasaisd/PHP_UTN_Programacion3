<?php

/* 
6- (2 pts.) ModificarVenta.php(por PUT), debe recibir el número de pedido, el email del usuario, el sabor,tipo y
cantidad, si existe se modifica , de lo contrario informar.
*/


echo 'Modificar' . PHP_EOL;

include_once './biblioteca.php';
$array_venta = ReadJson('./venta.json');

if (
    ValidarEmpty('sabor', $_PUT)
    && ValidarEmpty('tipo', $_PUT)
    && ValidarNumeric('cantidad', $_PUT)
    && ValidarNumeric('nro_de_pedido', $_PUT)
    && ValidarEmpty('mail', $_PUT)
) {

    foreach($array_venta as $venta)
    {
        if($_PUT['nro_de_pedido'] == $venta->nro_de_pedido)
        {
            $venta->mail = $_PUT['mail'];
            $venta->sabor = $_PUT['sabor'];
            $venta->tipo = $_PUT['tipo'];
            $venta->cantidad = $_PUT['cantidad'];
        }
    }


}

WriteJson($array_venta, './venta.json');