<?php

/* 
7- (2 pts.) borrarVenta.php(por DELETE), debe recibir un número de pedido,se borra la venta y la foto se mueve a
la carpeta /BACKUPVENTAS
*/


include_once './biblioteca.php';
$array_venta = ReadJson('./venta.json');

if (
    ValidarNumeric('nro_de_pedido', $_DELETE)
) {

    $array_venta = Venta::BorrarVenta($array_venta, $_DELETE['nro_de_pedido']);
    // Venta::MoverImagen()
}


WriteJson($array_venta, './venta.json');
