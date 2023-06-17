<?php


include_once './models/biblioteca.php';
include_once './models/Hamburguesa.php';
include_once './models/Venta.php';
include_once './models/Devolucion.php';
include_once './models/Cupon.php';

$array_devoluciones = ReadJson('./devoluciones.json');
$array_ventas = ReadJson('./venta.json');



if (
    ValidarNumeric('nro_de_pedido', $_POST)
    && ValidarEmpty('descripcion', $_POST)
) {

    $array_devoluciones = Devolucion::AddDevolucion($array_ventas, $array_devoluciones, new Devolucion($_POST['nro_de_pedido'], $_POST['descripcion']));
}


WriteJson($array_devoluciones, './devoluciones.json');


var_dump(Cupon::ValidarCupon(20655));