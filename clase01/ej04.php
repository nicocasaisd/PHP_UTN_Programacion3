<?php
/*
Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.


CASAIS DASSIE, NICOLÁS
*/
echo '<h1>Ejercicio 04</h1>';

$operador = '/';

$op1 = 10;
$op2 = 5;


echo 'Operacion: ', $op1, $operador, $op2;
echo '</br>';
echo 'Resultado: ';

switch ($operador) {
    case '*':
        echo $op1 * $op2;
        break;
    case '/':
        echo $op1 / $op2;
        break;
    case '+':
        echo $op1 + $op2;
        break;
    case '-':
        echo $op1 - $op2;
        break;
    default:
        echo 'El operador ingresado es invalido';
        break;
}

?>