<?php
/*
Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.
*/
    $i = 0;
    $suma = 0;
    do{
        $i++;
        $suma += $i;
        echo 'Suma: ', $suma, ', i: ', $i, '<br/>';
        

    }while($suma<1000);

    printf('Cantidad de numeros sumados: %d', $i);
?>