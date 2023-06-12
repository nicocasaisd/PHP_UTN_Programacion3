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

// ESCRIBIR A JSON

$archivo = fopen("./usuarios.json", "a");
        if (fputs($archivo, json_encode($usuario) . PHP_EOL) > 0) {
            echo "Se agrego el usuario. <br/>";
        }

// LEER DE JSON

    $array_de_usuarios = json_decode(file_get_contents('./usuarios.json'));
    echo $array_de_usuarios->fecha_de_registro;
    // Datetime
    $date = new DateTime($array_de_usuarios->fecha_de_registro->date);
    echo $date->format('d/m/Y');


// LEER FORMAT DATE

$date = DateTime::createFromFormat("d/m/y", $array[0]);
if ($date == false) {
    echo "Ocurrio un error";
}

// FORMAT DATE

$dateString = $obj->_fecha->format("d/m/y");

// MANEJAR DIRECTORIOS

if (!is_dir('./Usuario/Fotos')) 
{
    mkdir('./Usuario/Fotos', 0777, true);
}
