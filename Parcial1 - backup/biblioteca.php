<?php


function ReadJson($path)
{
    $array = [];
    if (file_exists($path)) {
        $array = json_decode(file_get_contents($path));
    }

    return $array;
}

function WriteJson($array, $path)
{
    $archivo = fopen($path, 'w');
    if (fputs($archivo, json_encode($array) . PHP_EOL) > 0) {
        echo "Se escribio el archivo json." . PHP_EOL;
    }
}


function ValidarNumeric(string $variable, $METODO)
{
    if (isset($METODO[$variable]) && is_numeric($METODO[$variable])) {
        return true;
    }
    return false;
}

function ValidarEmpty($variable, $METODO)
{
    if (isset($METODO[$variable]) && !empty($METODO[$variable])) {
        return true;
    }
    return false;
}
