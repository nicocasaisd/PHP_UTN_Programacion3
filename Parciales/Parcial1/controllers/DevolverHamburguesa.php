<?php


include_once '../models/biblioteca.php';
include_once '../models/Hamburguesa.php';
include_once '../models/Venta.php';
include_once './models/Devolucion.php';

$array_devoluciones = ReadJson('./devoluciones.json');
$array_ventas = ReadJson('./venta.json');



if (
    ValidarNumeric('nro_de_pedido', $_POST)
    && ValidarEmpty('descripcion', $_POST)
) {
    foreach ($array_ventas as $venta) {
        if ($venta->nro_de_pedido == $_POST['nro_de_pedido']) {
            $array_devoluciones = Devolucion::AddDevolucion($array_devoluciones, new Devolucion($_POST['nro_de_pedido'], $_POST['descripcion']));
            Devolucion::GuardarImagen("ClienteEnojado" . $_POST['nro_de_pedido']);
            echo "Se agrego la devolucion" . PHP_EOL;
        }
        else{
            echo "No se encontro numero de pedido" . PHP_EOL;
        }
    }
}


WriteJson($array_devoluciones, './devoluciones.json');
