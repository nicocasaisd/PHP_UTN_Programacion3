<?php
/* 
Aplicación Nº 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapicera
*/

echo '<h1>Ejercicio 09 y 10</h1>';

// Creamos el array asociativo
$lapicera1 = array('color' => 'azul', 'marca' => 'bic', 'trazo' => 'fino', 'precio' => 100);
$lapicera2 = array('color' => 'rojo', 'marca' => 'faber', 'trazo' => 'grueso', 'precio' => 80);
$lapicera3 = array('color' => 'verde', 'marca' => 'maped', 'trazo' => 'semi-grueso', 'precio' => 150);

// Creamos el array de arrays (indexado)
$arr_de_lapiceras = array($lapicera1, $lapicera2, $lapicera3);

// Creamos el array de arrays (asociativo)
$lapiceras_asociativo['L1'] = $lapicera1;
$lapiceras_asociativo['L2'] = $lapicera2;
$lapiceras_asociativo['L3'] = $lapicera3;

// Mostramos

echo '<h1>Array asociativo <h1/>';
foreach ($lapiceras_asociativo as $key => $lapicera) {
    echo '<h3> Lapicera </h3>';
    foreach($lapicera as $key => $value){
        echo $key,': ', $value, '<br/>';
    }

}
echo '<h1>Array indexadao <h1/>';
foreach ($arr_de_lapiceras as $lapicera) {
    echo '<h3> Lapicera </h3>';
    foreach ($lapicera as $key => $value) {
        echo $key,': ', $value, '<br/>';
    }
}
