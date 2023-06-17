<?php


include_once './models/biblioteca.php';
include_once './models/Hamburguesa.php';
include_once './models/Venta.php';
include_once './models/Cupon.php';

$array_hamburguesa = ReadJson('./hamburguesa.json');
$array_venta = ReadJson('./venta.json');


if (
    ValidarEmpty('nombre', $_POST)
    && ValidarEmpty('tipo', $_POST)
    && ValidarEmpty('aderezo', $_POST)
    && ValidarNumeric('cantidad', $_POST)
    && ValidarEmpty('mail', $_POST)
) {

    //$hamburguesa = new hamburguesa($_POST['nombre'], $_POST['tipo'], 0, $_POST['cantidad']);

    if (Hamburguesa::ConsultarStock($array_hamburguesa, $_POST['nombre'], $_POST['tipo'], $_POST['cantidad'])) {
        $hamburguesa = Hamburguesa::Get($array_hamburguesa,  $_POST['nombre'], $_POST['tipo']);
        // $nueva_venta = new Venta(new DateTime(), $_POST['mail'], $hamburguesa->id, $hamburguesa->nombre, $hamburguesa->tipo, $hamburguesa->aderezo, $_POST['cantidad']);
        
        // Si hay, agrego cupon de descuento
        if(ValidarEmpty('id_cupon', $_POST)){
            $nueva_venta = new Venta(new DateTime(), $_POST['mail'], $hamburguesa->id, $hamburguesa->nombre, $hamburguesa->tipo, $hamburguesa->aderezo, $_POST['cantidad'], $_POST['id_cupon']);
        }
        else{
            $nueva_venta = new Venta(new DateTime(), $_POST['mail'], $hamburguesa->id, $hamburguesa->nombre, $hamburguesa->tipo, $hamburguesa->aderezo, $_POST['cantidad']);
        }
        
        array_push($array_venta, $nueva_venta);
        // Resto stock
        $array_hamburguesa = Hamburguesa::RemoveStock($array_hamburguesa, $hamburguesa, $_POST['cantidad']);
        // Guardo la imagen
        $usuario = strstr($_POST['mail'], '@', true);
        Venta::GuardarImagen($_POST['tipo'] . $_POST['nombre'] . $usuario . $nueva_venta->fecha->format('dmy'));
    } else {
        echo "No hay stock del elemento solicitado" . PHP_EOL;
    }
}


WriteJson($array_hamburguesa, './hamburguesa.json');
WriteJson($array_venta, './venta.json');

/* 
b- (1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+nombre+mail(solo usuario hasta
el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.
*/
