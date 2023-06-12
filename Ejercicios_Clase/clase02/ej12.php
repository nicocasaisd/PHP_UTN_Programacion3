<?php
/* 
Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
*/

echo strrev('Hola mundo');

function mi_strrev($string)
{
    $n = strlen($string);
    //echo $n;
    $reversed_str = '';
    for ($i = 1; $i <= $n; $i++) {
        $reversed_str = $reversed_str . $string[-$i];
        //echo $i;
    }

    return $reversed_str;
}

echo '<br/>', 'Mi funcion: ';
echo '<br/>';
echo mi_strrev('Mi funcion');

echo '<h1> Mini prueba array</h1>';
$arr[] = 1;
$arr[] = 2;
$arr[] = 3;

foreach($arr as $elemento){
    echo $elemento, '<br>';
}