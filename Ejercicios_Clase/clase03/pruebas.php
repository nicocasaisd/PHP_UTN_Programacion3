<?php

/* // Usando fwrite()
$archivo = fopen("archivo.txt","w");
echo fwrite($archivo,"Prueba de guardado");
fclose($archivo); */

// Usando fputs()
$archivo = fopen("archivo.txt","w");
echo fputs($archivo,"Prueba de guardado\n");
echo fwrite($archivo, "Prueba fwrite\n");
echo fwrite($archivo, "a");
fclose($archivo);

echo copy("archivo.txt","archivoCopiado.txt");

// Leer con un while
$archivo = fopen("archivo.txt", "r");
echo "<h3> Leemos con un while </h3>";
while(!feof($archivo))
{
    echo fgets($archivo) . "<br/>";
}

// Escribir datetime
echo "<h3> Escribir datetime </h3>";
$date = new DateTime();

$date_string = $date->format("d/m/y");

echo $date_string . "<br/>";

$new_date = DateTime::createFromFormat("d/m/y", $date_string);

var_dump($new_date);