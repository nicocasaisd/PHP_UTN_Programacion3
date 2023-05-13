<?php

// Clase PIZZA

class Pizza
{
    public int $id;
    public string $sabor;
    public string $tipo;
    public float $precio;
    public int $cantidad;

    public function __construct($sabor = "", $tipo = "", $precio = 0, $cantidad = 0)
    {
        $this->id = rand(1, 10000);
        $this->sabor = $sabor;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    public function __get($atributo)
    {
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }


    static function AddPizza($array, $pizza)
    {
        foreach ($array as $item) {
            if ($item->sabor == $pizza->sabor && $item->tipo == $pizza->tipo) {
                $item->precio = $pizza->precio;
                $item->cantidad += $pizza->cantidad;
                echo 'Pizza actualizada' . PHP_EOL;
                return $array;
            }
        }
        array_push($array, $pizza);
        echo 'Pizza nueva agregada' . PHP_EOL;

        return $array;
    }

    static function GetPizza($array, $sabor, $tipo)
    {
        foreach ($array as $item) {
            if ($item->sabor == $sabor && $item->tipo == $tipo) {
                //var_dump($item);
                return $item;
            }
        }

        return "";
    }

    static function ConsultarStockPizza($array, $sabor, $tipo, $cantidad)
    {
        $pizza = self::GetPizza($array, $sabor, $tipo);
        if ($pizza->cantidad >= $cantidad) {
            //var_dump($item);
            return true;
        }


        return false;
    }
}

class Venta
{
    public int $nro_de_pedido;
    public Pizza $pizza;
    public DateTime $fecha;


    public function __construct()
    {
        $this->nro_de_pedido = rand(10000, 20000);
    }
}



function ReadJson()
{
    $array = [];
    if (file_exists('./pizza.json')) {
        $array = json_decode(file_get_contents('./pizza.json'));
    }

    return $array;
}

function WriteJson($array)
{
    $archivo = fopen("pizza.json", "w");
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
