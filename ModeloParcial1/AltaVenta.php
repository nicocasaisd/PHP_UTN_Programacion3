<?php
/* 
3-
a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock .
*/

include_once './biblioteca.php';

$array = ReadJson();

if (
    ValidarEmpty('sabor', $_POST)
    && ValidarEmpty('tipo', $_POST)
    && ValidarNumeric('cantidad', $_POST)
    && ValidarEmpty('mail', $_POST)
) {
    
    $pizza = new Pizza($_POST['sabor'], $_POST['tipo'], 0, $_POST['cantidad']);

    if(Pizza::ConsultarStockPizza($array, $_POST['sabor'], $_POST['tipo'], $_POST['cantidad']))
    {
        
    }
    

}