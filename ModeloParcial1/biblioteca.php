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
    public DateTime $fecha;
    public int $id_autoincremental;
    public string $sabor;
    public string $tipo;
    public int $cantidad;


    public function __construct(DateTime $fecha, int $id_autoincremental, $sabor, $tipo, $cantidad)
    {
        $this->nro_de_pedido = rand(10000, 20000);
        $this->fecha = $fecha;
        $this->id_autoincremental = $id_autoincremental;
        $this->sabor = $sabor;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
    }

    public static function GuardarImagen($nombreImagen)
    {
        if (!empty($_FILES)) {
            if (!is_dir('./ImagenesDeLaVenta')) {
                mkdir('./ImagenesDeLaVenta', 0777, true);
            }
            move_uploaded_file($_FILES['imagen_venta']['tmp_name'], './ImagenesDeLaVenta/' . $nombreImagen . '.jpg');
        }
    }
}



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
