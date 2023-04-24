<?php
/*
Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido. Ejemplo 1: $a
= 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”

CASAIS DASSIE, NICOLÁS
*/
$a = 1;
$b = 4;
$c = 8;

$arreglo = array($a, $b, $c);

sort($arreglo);

// Mensaje
if($arreglo[0] == $arreglo[1] || $arreglo[2] == $arreglo[1])
{
    echo 'No hay valor del medio';
}
else
{
    echo 'Numero del medio: ', $arreglo[1];
}

?>