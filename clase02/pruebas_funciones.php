<?php
/* 
Pruebas de funciones
*/

echo '<h1> Pruebas de funciones</h1>';

function contarelementos($arr=array(1,2,3))
{
    $contador = 0;
    foreach ($arr as $item) {
        $contador++;
    }

    return $contador;
}

$arr_num = array(1, 2, 3, 4, 5, 6, 7, 8);

echo 'Cantidad de elementos: ', ContarElementos($arr_num);
echo '<br/>';
echo 'Cantidad de elementos por defecto (sin pasar parametros): ', ContarElementos();