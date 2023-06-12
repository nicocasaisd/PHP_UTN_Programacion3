<?php
/* 
Aplicación No 13 (Invertir palabra)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán: 1 si la palabra
pertenece a algún elemento del listado.
0 en caso contrario.
*/

echo '<h1>Ejercicio 13</h1>';

function validar_palabra($palabra, $max)
{
    $array_de_palabras = array('Recuperatorio', 'Parcial', 'Programacion');
    if (strlen($palabra) < $max) {
        if (in_array($palabra, $array_de_palabras)) {
            echo 'correcto';
            return 1;
        } else {
            echo 'incorrecto';
            return 0;
        }
    } else {
        return 0;
    }
}


echo validar_palabra('Recuperatorio', 15);
