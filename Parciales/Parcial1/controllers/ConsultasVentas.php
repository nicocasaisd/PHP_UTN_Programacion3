<?php


include_once './models/biblioteca.php';
include_once './models/Hamburguesa.php';
include_once './models/Venta.php';

$array_venta = ReadJson('./venta.json');


/* 
    a- la cantidad de Hamburguesas vendidas
*/
if()

$totalVendidas = Venta::ConsultarTotalVendidas($array_venta, $_GET['fecha_inicio']);

echo "*** Total de Hamburguesas vendidas: " . $totalVendidas . PHP_EOL;
echo PHP_EOL;

/* 
    b- el listado de ventas entre dos fechas ordenado por sabor.
 */

if (
    ValidarEmpty('fecha_inicio', $_GET)
    && ValidarEmpty('fecha_final', $_GET)
) {
    if (($fecha_inicio = DateTime::createFromFormat('d-m-y', $_GET['fecha_inicio'])) &&
        ($fecha_final = DateTime::createFromFormat('d-m-y', $_GET['fecha_final']))
    ) {
        // var_dump($fecha_inicio);
        // var_dump($fecha_final);
        $listaVentasEnRango = Venta::ConsultarVentasEntreFechas($array_venta, $fecha_inicio, $fecha_final);
    }


    echo "*** Listado de Ventas entre " . $fecha_inicio->format('d-m-y') . ' y ' .  $fecha_final->format('d-m-y') . " ordenadas por nombre:" . PHP_EOL;
    foreach ($listaVentasEnRango as $venta) {
        Venta::MostrarVenta($venta);
    }
    echo PHP_EOL;
}


/* 
c- el listado de ventas de un usuario ingresado
*/
if (ValidarEmpty('mail', $_GET)) {
    echo "*** Listado de ventas del usuario " . $_GET['mail'] .  ": " . PHP_EOL;
    foreach ($array_venta as $venta) {
        if ($_GET['mail'] == $venta->mail) {
            Venta::MostrarVenta($venta);
        }
    }
    echo PHP_EOL;
}

/* 
d- el listado de ventas de un sabor ingresado
*/

if (ValidarEmpty('tipo', $_GET)) {
    echo "*** Listado de ventas del tipo " . $_GET['tipo'] .  ": " . PHP_EOL;
    foreach ($array_venta as $venta) {
        if ($_GET['tipo'] == $venta->tipo) {
            Venta::MostrarVenta($venta);
        }
    }
    echo PHP_EOL;
}

/* 
e- Listado de ventas de aderezo “Ketchup”
*/


echo "*** Listado de ventas del aderezo KETCHUP : " . PHP_EOL;
foreach ($array_venta as $venta) {
    if ('Ketchup' == $venta->aderezo) {
        Venta::MostrarVenta($venta);
    }
}
echo PHP_EOL;
