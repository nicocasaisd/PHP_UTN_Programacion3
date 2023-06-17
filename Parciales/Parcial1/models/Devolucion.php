<?php


class Devolucion
{
    public int $nro_de_pedido;
    public string $descripcion;

    public function __construct($nro_de_pedido, $descripcion)
    {
        $this->nro_de_pedido = $nro_de_pedido;
        $this->descripcion = $descripcion;
    }

    static function AddDevolucion($array_ventas, $array_devoluciones, $devolucion)
    {
        foreach ($array_ventas as $venta) {
            if ($venta->nro_de_pedido == $_POST['nro_de_pedido']) {
                array_push($array_devoluciones, $devolucion);
                Devolucion::GuardarImagen("ClienteEnojado" . $_POST['nro_de_pedido']);
                echo "Se agrego la devolucion" . PHP_EOL;
                Cupon::AddCupon(new Cupon($_POST['nro_de_pedido'], 10));

                return $array_devoluciones;
            }
        }
        echo "No se encontro numero de pedido" . PHP_EOL;
        return $array_devoluciones;
    }

    public static function GuardarImagen($nombreImagen)
    {
        if (!empty($_FILES)) {
            if (!is_dir('./ClienteEnojado')) {
                mkdir('./ClienteEnojado', 0777, true);
            }
            move_uploaded_file($_FILES['imagen']['tmp_name'], './ClienteEnojado/' . $nombreImagen . '.jpg');
        }
    }
}
