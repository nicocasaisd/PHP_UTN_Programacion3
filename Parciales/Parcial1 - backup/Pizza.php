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

    static function RemoveStockPizza($array, $pizza, $cantidad)
    {
        foreach ($array as $item) {
            if ($item->sabor == $pizza->sabor && $item->tipo == $pizza->tipo) {
                $item->cantidad -= $cantidad;
                echo 'Se descontó del stock' . PHP_EOL;
                return $array;
            }
        }

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
        if ($pizza = self::GetPizza($array, $sabor, $tipo)) {


            if ($pizza->cantidad >= $cantidad) {
                //var_dump($item);
                return true;
            }
        }

        return false;
    }
}
