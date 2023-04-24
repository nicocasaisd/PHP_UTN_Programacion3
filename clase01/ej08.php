<?php
/* 
Aplicación Nº 8 (Carga aleatoria)
Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';

CASAIS DASSIE, NICOLÁS
*/

echo '<h1>Ejercicio 08</h1>';

// Creamos el array asociativo

$v[1] = 90;
$v[30] = 7;
$v['e'] = 99;
$v['hola'] = 'mundo';

foreach ($v as $key => $value) {
    echo 'Valor del elemento ', $key, ': ', $value, '<br/>';
}
