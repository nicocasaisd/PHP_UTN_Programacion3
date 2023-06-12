<?php
/* 
Aplicación Nº 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.

CASAIS DASSIE, NICOLÁS
*/

echo '<h1>Ejercicio 06</h1>';

// Generamos un array de números aleatorios

$arr_num = array(
    rand(-100,100),
    rand(-100,100),
    rand(-100,100),
    rand(-100,100),
    rand(-100,100),
);

foreach($arr_num as $num)
{
    echo 'Numero: ',$num, '<br>';
}

// Calculamos el promedio del array
echo '</br>';

$prom = array_sum($arr_num) / count($arr_num);

echo 'Suma: ', array_sum($arr_num);
echo '</br>';
echo 'Cantidad: ', count($arr_num);
echo '</br>';
echo 'Promedio: ', $prom;

if($prom >= 6){
    echo '<h2> El promedio es MAYOR a 6 </h2>';
}
else{
    echo '<h2> El promedio es MENOR a 6 </h2>';
}