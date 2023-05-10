<?php


// ESCRIBIR A CSV

$archivo = fopen("./archivo.csv", "a");


$strObj = $obj->atributo1 . "," . $obj->atributo2 . "," . $obj->atributo3 .  PHP_EOL;
fputs($archivo, $strAuto);



// LEER CSV TO ARRAY

$archivo = fopen($path, "r");

while (!feof($archivo)) {
    $line = fgets($archivo);
    if ($line != null) {
        $array = str_getcsv($line, ",");
        var_dump($array);
    }
}

// LEER FORMAT DATE

$date = DateTime::createFromFormat("d/m/y", $array[0]);
if ($date == false) {
    echo "Ocurrio un error";
}

// FORMAT DATE

$dateString = $obj->_fecha->format("d/m/y");