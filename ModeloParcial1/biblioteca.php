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

class Venta
{
    public int $nro_de_pedido;
    public DateTime $fecha;
    public string $mail;
    public int $id_autoincremental;
    public string $sabor;
    public string $tipo;
    public int $cantidad;


    public function __construct(DateTime $fecha, string $mail,  int $id_autoincremental, $sabor, $tipo, $cantidad)
    {
        $this->nro_de_pedido = rand(10000, 20000);
        $this->mail = $mail;
        $this->fecha = $fecha;
        $this->id_autoincremental = $id_autoincremental;
        $this->sabor = $sabor;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
    }

    public static function MostrarVenta($objeto)
    {
        echo $objeto->nro_de_pedido . ', ' . $objeto->fecha->date . ', ' . $objeto->mail . ', ' . $objeto->sabor . ', ' . $objeto->tipo . ', ' . $objeto->cantidad . PHP_EOL;
    }

    public static function GuardarImagen($nombreImagen)
    {
        if (!empty($_FILES)) {
            if (!is_dir('./ImagenesDeLaobjeto')) {
                mkdir('./ImagenesDeLaVenta', 0777, true);
            }
            move_uploaded_file($_FILES['imagen_venta']['tmp_name'], './ImagenesDeLaVenta/' . $nombreImagen . '.jpg');
        }
    }

    public static function MoverImagen($ruta, $nueva_ruta)
    {
        if (file_exists($ruta)) {
            if (!is_dir('./BackUpVentas')) {
                mkdir('./BackUpVentas', 0777, true);
            }
            if (rename($ruta, $nueva_ruta)) {
                echo "Archivo movido correctamente" . PHP_EOL;
            } else {
                echo "Error al intentar mover el archivo" . PHP_EOL;
            }
        }
    }

    public static function ModificarVenta($array_venta, $request)
    {
        foreach ($array_venta as $venta) {
            if ($request['nro_de_pedido'] == $venta->nro_de_pedido) {
                $venta->mail = $request['mail'];
                $venta->sabor = $request['sabor'];
                $venta->tipo = $request['tipo'];
                $venta->cantidad = $request['cantidad'];

                return $array_venta;
            }
        }

        echo "No se encontró un elemento que coincida con la id " . $request['nro_de_pedido'] . PHP_EOL;
        return  $array_venta;
    }

    public static function BorrarVenta($array_venta, $nro_de_pedido)
    {
        foreach ($array_venta as $key => $venta) {
            if ($nro_de_pedido == $venta->nro_de_pedido) {
                $usuario = strstr($venta->mail, '@', true);
                // Convierto el objeto stdClass en objeto DateTime
                $fecha = new DateTime($venta->fecha->date);
                $fecha = $fecha->format('dmy');
                $nombre_archivo = $venta->tipo . $venta->sabor . $usuario . $fecha . ".jpg";
                self::MoverImagen("./ImagenesDeLaVenta/" . $nombre_archivo, "./BackUpVentas/" . $nombre_archivo);
                array_splice($array_venta, $key, 1);

                return $array_venta;
            }
        }

        echo "No se encontró un elemento que coincida con la id " . $nro_de_pedido . PHP_EOL;
        return  $array_venta;
    }

    public static function ConsultarTotalVendidas($array_venta)
    {
        $totalPizzasVendidas = 0;
        foreach ($array_venta as $venta) {
            $totalPizzasVendidas += $venta->cantidad;
        }

        return $totalPizzasVendidas;
    }

    public static function ConsultarVentasEntreFechas($array_venta, $fecha_inicio, $fecha_final)
    {
        $listaVentasEnRango = [];

        foreach ($array_venta as $venta) {
            // Convierto el objeto stdClass en objeto DateTime
            $fecha = new DateTime($venta->fecha->date);
            if ($fecha >= $fecha_inicio && $fecha <= $fecha_final) {
                array_push($listaVentasEnRango, $venta);
            }
        }

        usort($listaVentasEnRango, 'comparadora');

        return $listaVentasEnRango;
    }
}

function comparadora($obj1, $obj2)
{
    return $obj1->sabor > $obj2->sabor;
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
