<?php
/* 
Aplicación Nº 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números
utilizando las estructuras while y foreach.

CASAIS DASSIE, NICOLÁS
*/

echo '<h1>Ejercicio 07</h1>';

// Agregamos los 10 primeros números impares a un array
$i=0;
$numero=0;
$arr = array();

while($i < 10)
{
    if(($numero%2) != 0)
    {
        $arr[] = $numero;
        //echo $numero, '<br>';
        $i += 1;
    }
    $numero += 1;
}

// Imprimimos utilizando FOR
echo '<h3>Utilizando FOR</h3>';

for($i=0; $i < count($arr); $i++){
    echo 'Posición ', $i, ': ', $arr[$i], '<br/>';
}

// Imprimimos utilizando WHILE
echo '<h3>Utilizando WHILE</h3>';
$j = 0;

while($j < count($arr))
{
    echo 'Posición ', $j, ': ', $arr[$j], '<br/>';
    
    $j += 1;
}

// Imprimimos utilizando FOREACH
echo '<h3>Utilizando FOREACH</h3>';

foreach($arr as $numero){
    echo $numero, '<br/>';
}