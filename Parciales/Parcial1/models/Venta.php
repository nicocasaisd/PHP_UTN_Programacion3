<?php

// Clase Venta

class Venta
{
    public int $nro_de_pedido;
    public DateTime $fecha;
    public string $mail;
    public int $id_autoincremental;
    public string $nombre;
    public string $tipo;
    public string $aderezo;
    public int $cantidad;
    public float $id_cupon;
    public float $importe_final;


    public function __construct(DateTime $fecha, string $mail,  int $id_autoincremental, $nombre, $tipo, $aderezo, $cantidad, $id_cupon=-1)
    {
        $this->nro_de_pedido = rand(10000, 20000);
        $this->mail = $mail;
        $this->fecha = $fecha;
        $this->id_autoincremental = $id_autoincremental;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->aderezo = $aderezo;
        $this->cantidad = $cantidad;
        $this->id_cupon = $id_cupon;
        $this->importe_final = $this->CalcularImporteFinal();
    }

    private function CalcularImporteFinal()
    {
        $precio_unitario = Hamburguesa::GetPrecio($this->id_autoincremental);
        $importe = $this->cantidad * $precio_unitario;
        if($this->id_cupon > 0){
            $importe = Cupon::AplicarDescuento($this->id_cupon, $importe);
        }

        return $importe;
    }

    public static function MostrarVenta($objeto)
    {
        echo $objeto->nro_de_pedido . ', ' . $objeto->fecha->date . ', ' . $objeto->mail . ', ' . $objeto->nombre . ', ' . $objeto->tipo . ', ' . $objeto->aderezo . ', '. $objeto->cantidad . ', '. $objeto->id_cupon. PHP_EOL;
    }

    public static function GuardarImagen($nombreImagen)
    {
        if (!empty($_FILES)) {
            if (!is_dir('./ImagenesDeLaVenta')) {
                mkdir('./ImagenesDeLaVenta', 0777, true);
            }
            move_uploaded_file($_FILES['imagen_venta']['tmp_name'], './ImagenesDeLaVenta/' . $nombreImagen . '.jpg');
        }
        else{ echo "No se envió ningún archivo." . PHP_EOL;}
    }

    public static function MoverImagen($ruta, $nueva_ruta)
    {
        if (file_exists($ruta)) {
            if (!is_dir('./BackUpVentas/2023/')) {
                mkdir('./BackUpVentas/2023/', 0777, true);
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
                $venta->nombre = $request['nombre'];
                $venta->tipo = $request['tipo'];
                $venta->aderezo = $request['aderezo'];
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
                $nombre_archivo = $venta->tipo . $venta->nombre . $usuario . $fecha . ".jpg";
                self::MoverImagen("./ImagenesDeLaVenta/" . $nombre_archivo, "./BackUpVentas/2023/" . $nombre_archivo);
                array_splice($array_venta, $key, 1);

                return $array_venta;
            }
        }

        echo "No se encontró un elemento que coincida con la id " . $nro_de_pedido . PHP_EOL;
        return  $array_venta;
    }

    public static function ConsultarTotalVendidas($array_venta, $fecha_ingresada)
    {
        // var_dump($fecha_ingresada);
        $totalVendidas = 0;
        foreach ($array_venta as $venta) {
            $fecha = new DateTime($venta->fecha->date);
            if ($fecha->format('d-m-y') == $fecha_ingresada) {
                $totalVendidas += $venta->cantidad;
            }
        }

        return $totalVendidas;
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
    return $obj1->nombre > $obj2->nombre;
}
