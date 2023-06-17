<?php


include_once './models/biblioteca.php';
include_once './models/Hamburguesa.php';
include_once './models/Venta.php';
include_once './models/Cupon.php';
include_once './models/Devolucion.php';

$array_cupones = ReadJson('./cupones.json');
$array_devoluciones = ReadJson('./devoluciones.json');


/* 
    a- Listar las devoluciones con cupones
    */
echo "*** Lista de Devoluciones : " . PHP_EOL;

foreach ($array_devoluciones as $devolucion) {
    Devolucion::Mostrar($devolucion);
}

echo PHP_EOL;

echo "*** Lista de Cupones : " . PHP_EOL;

foreach ($array_cupones as $cupon) {
    Cupon::Mostrar($cupon);
}

echo PHP_EOL;
