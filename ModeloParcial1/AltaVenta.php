<?php
/* 
3-
a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock .
*/

include_once './biblioteca.php';

$array_pizza = ReadJson('./pizza.json');
$array_venta = ReadJson('./venta.json');

if (
    ValidarEmpty('sabor', $_POST)
    && ValidarEmpty('tipo', $_POST)
    && ValidarNumeric('cantidad', $_POST)
    && ValidarEmpty('mail', $_POST)
) {

    //$pizza = new Pizza($_POST['sabor'], $_POST['tipo'], 0, $_POST['cantidad']);

    if (Pizza::ConsultarStockPizza($array_pizza, $_POST['sabor'], $_POST['tipo'], $_POST['cantidad'])) {
        $pizza = Pizza::GetPizza($array_pizza,  $_POST['sabor'], $_POST['tipo']);
        $nueva_venta = new Venta(new DateTime(), $_POST['mail'], $pizza->id, $pizza->sabor, $pizza->tipo, $_POST['cantidad']);
        array_push($array_venta, $nueva_venta);
        // Resto stock
        $array_pizza = Pizza::RemoveStockPizza($array_pizza, $pizza, $_POST['cantidad']);
        // Guardo la imagen
        $usuario = strstr($_POST['mail'], '@', true);
        Venta::GuardarImagen($_POST['tipo'] . $_POST['sabor'] . $usuario . $nueva_venta->fecha->format('dmy'));
    } else {
        echo "No hay stock del elemento solicitado" . PHP_EOL;
    }
}


WriteJson($array_pizza, './pizza.json');
WriteJson($array_venta, './venta.json');

/* 
b- (1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta
el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.
*/
