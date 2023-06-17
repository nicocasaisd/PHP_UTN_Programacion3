<?php

// Clase Hamburguesa

class Hamburguesa
{
    public int $id;
    public string $nombre;
    public float $precio;
    public string $tipo;
    public string $aderezo;
    public int $cantidad;

    public function __construct($nombre = "", $precio = 0, $tipo = "", $aderezo, $cantidad = 0)
    {
        $this->id = rand(1, 10000);
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->aderezo = $aderezo;
        $this->cantidad = $cantidad;
    }

    public function __get($atributo)
    {
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }


    static function Add($array, $hamburguesa)
    {
        foreach ($array as $item) {
            if ($item->nombre == $hamburguesa->nombre && $item->tipo == $hamburguesa->tipo) {
                $item->precio = $hamburguesa->precio;
                $item->cantidad += $hamburguesa->cantidad;
                echo 'hamburguesa actualizada' . PHP_EOL;
                return $array;
            }
        }
        array_push($array, $hamburguesa);
        echo 'hamburguesa nueva agregada' . PHP_EOL;

        return $array;
    }

    static function RemoveStock($array, $hamburguesa, $cantidad)
    {
        foreach ($array as $item) {
            if ($item->nombre == $hamburguesa->nombre && $item->tipo == $hamburguesa->tipo) {
                $item->cantidad -= $cantidad;
                echo 'Se descontó del stock' . PHP_EOL;
                return $array;
            }
        }

        return $array;
    }

    static function Get($array, $nombre, $tipo)
    {
        foreach ($array as $item) {
            if ($item->nombre == $nombre && $item->tipo == $tipo) {

                return $item;
            }
        }

        return "";
    }

    static function ConsultarStock($array, $nombre, $tipo, $cantidad)
    {
        if ($hamburguesa = self::Get($array, $nombre, $tipo)) {


            if ($hamburguesa->cantidad >= $cantidad) {
                //var_dump($item);
                return true;
            }
        }

        return false;
    }

    static function GetPrecio($id)
    {
        $array = ReadJson('./hamburguesa.json');

        foreach ($array as $hamburguesa) {
            if ($hamburguesa->id == $id) {
                return $hamburguesa->precio;
            }
        }

        return false;
    }

    public static function GuardarImagen($nombreImagen)
    {
        if (!empty($_FILES)) {
            if (!is_dir('./ImagenesDeHamburguesas/2023')) {
                mkdir('./ImagenesDeHamburguesas/2023', 0777, true);
            }
            move_uploaded_file($_FILES['imagen']['tmp_name'], './ImagenesDeHamburguesas/2023/' . $nombreImagen . '.jpg');
        }
    }
}
