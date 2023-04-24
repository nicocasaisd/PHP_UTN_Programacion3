<?php

/* // Usando fwrite()
$archivo = fopen("archivo.txt","w");
echo fwrite($archivo,"Prueba de guardado");
fclose($archivo); */

// Usando fputs()
$archivo = fopen("archivo.txt","w");
echo fputs($archivo,"Prueba de guardado");
fclose($archivo);

echo copy("archivo.txt","archivoCopiado.txt");