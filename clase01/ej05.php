<?php
/* 
Aplicación Nº 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.


CASAIS DASSIE, NICOLÁS
*/


echo '<h1>Ejercicio 05</h1>';

$num = 12;

// Obtenemos la decena
$decena = intdiv($num, 10);
// echo 'Decena: ', $decena;

// Obtenemos la unidad
$unidad = $num % 10;
echo '</br>';
// echo 'Unidad: ', $unidad;

// Mostramos el número como letras
echo 'Número: ', $num;
echo '</br>';
echo 'Escrito: ';
switch ($decena) {
    case 2:
        echo 'Veinte';
        break;
    case 3:
        echo 'Treinta';
        break;
    case 4:
        echo 'Cuarenta';
        break;
    case 5:
        echo 'Cincuenta';
        break;
    case 6:
        echo 'Sesenta';
        break;
    default:
        echo 'Fuera de rango';
        exit;
        break;
}

echo ' y ';

switch ($unidad) {
    case 1:
        echo 'Uno';
        break;
    case 2:
        echo 'Dos';
        break;
    case 3:
        echo 'Tres';
        break;
    case 4:
        echo 'Cuatro';
        break;
    case 5:
        echo 'Cinco';
        break;
    case 6:
        echo 'Seis';
        break;
    case 7:
        echo 'Siete';
        break;
    case 8:
        echo 'Ocho';
        break;
    case 9:
        echo 'Nueve';
        break;
    default:
        break;
}
