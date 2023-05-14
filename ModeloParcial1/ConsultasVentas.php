<?php

/* 
4- (3 pts.)ConsultasVentas.php: necesito saber :
a- la cantidad de pizzas vendidas
b- el listado de ventas entre dos fechas ordenado por sabor.
c- el listado de ventas de un usuario ingresado
d- el listado de ventas de un sabor ingresado
*/

include_once './biblioteca.php';
$array_venta = ReadJson('./venta.json');


/* 
    a- la cantidad de pizzas vendidas
*/

$totalPizzasVendidas = 0;
foreach ($array_venta as $venta) {
    $totalPizzasVendidas += $venta->cantidad;
    // var_dump($venta->cantidad);
}
echo "*** Total de Pizzas vendidas: " . $totalPizzasVendidas . PHP_EOL;

/* 
    b- el listado de ventas entre dos fechas ordenado por sabor.
 */

$listaVentasEnRango = [];

if (
    ValidarEmpty('fecha_inicio', $_GET)
    && ValidarEmpty('fecha_final', $_GET)
) {
    if (($fecha_inicio = DateTime::createFromFormat('d-m-y', $_GET['fecha_inicio'])) &&
        ($fecha_final = DateTime::createFromFormat('d-m-y', $_GET['fecha_final']))
    ) {
        // var_dump($fecha_inicio);
        // var_dump($fecha_final);
        foreach ($array_venta as $venta) {
            // Convierto el objeto stdClass en objeto DateTime
            $fecha = new DateTime($venta->fecha->date);
            if ($fecha >= $fecha_inicio && $fecha <= $fecha_final) {
                array_push($listaVentasEnRango, $venta);
            }
        }
    }

    // Ordeno y muestro

    function comparadora($obj1, $obj2)
    {
        return $obj1->sabor > $obj2->sabor;
    }

    usort($listaVentasEnRango, 'comparadora');

    echo "*** Listado de Ventas entre " . $fecha_inicio->format('d-m-y') . ' y '.  $fecha_final->format('d-m-y') . " ordenadas por sabor:". PHP_EOL;
    foreach ($listaVentasEnRango as $venta) {
        echo $venta->nro_de_pedido .','. $venta->mail .',' . $venta->sabor .','. $venta->tipo .','. $venta->cantidad . PHP_EOL ;
    }
}


/* 
c- el listado de ventas de un usuario ingresado
*/
if(  ValidarEmpty('mail', $_GET))
{
    echo "*** Listado de ventas del usuario ". $_GET['mail'] .  ": " . PHP_EOL;
    foreach($array_venta as $venta)
    {
        if($_GET['mail'] == $venta->mail)
        {
            echo $venta->nro_de_pedido .','. $venta->mail .',' . $venta->sabor .','. $venta->tipo .','. $venta->cantidad . PHP_EOL ;
        }

    }
}

/* 
d- el listado de ventas de un sabor ingresado
*/

if(  ValidarEmpty('sabor', $_GET))
{
    echo "*** Listado de ventas del sabor ". $_GET['sabor'] .  ": " . PHP_EOL;
    foreach($array_venta as $venta)
    {
        if($_GET['sabor'] == $venta->sabor)
        {
            echo $venta->nro_de_pedido .','. $venta->mail .',' . $venta->sabor .','. $venta->tipo .','. $venta->cantidad . PHP_EOL ;
        }

    }
}