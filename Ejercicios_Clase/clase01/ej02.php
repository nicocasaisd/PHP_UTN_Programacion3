<?php
/*
Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.

CASAIS DASSIE, NICOLÁS
*/

# Función date() 
# Firma --> date(string $format, ?int $timestamp = null): string

    echo 'Week day: ', date('l'); // Día de la semana
    echo '<br/>';
    echo 'Fecha: ', date('d/m/y'); // Fecha con formato
    echo '<br/>';
    echo 'Hora: ', date('H:m:s'); // Hora
    echo '<br/>';

    // Estación del año
    $mes = date('m');
    $dia = date('d');

    print("Estacion: ");

    if($mes==1 || $mes == 2 || ($mes == 12 && $dia > 21) || ($mes == 3 && $dia < 21)){
        echo 'Verano';
    }
    else if(($mes==4 || $mes == 5 || ($mes == 3 && $dia > 21) || ($mes == 6 && $dia < 21))){
        echo 'Otoño';
    }
    else if(($mes==7 || $mes == 8 || ($mes == 6 && $dia > 21) || ($mes == 9 && $dia < 21))){
        echo 'Invierno';
    }
    else{
        echo 'Primavera';
    }

?>