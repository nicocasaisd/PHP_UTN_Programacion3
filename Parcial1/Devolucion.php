<?php


Class Devolucion
{
    public int $nro_de_pedido;
    public string $descripcion;

    public function __construct($nro_de_pedido, $descripcion)
    {
        $this->nro_de_pedido = $nro_de_pedido;
        $this->descripcion = $descripcion;
        
    }

    static function AddDevolucion($array, $cupon)
    {
        array_push($array, $cupon);

        return $array;
    }

    public static function GuardarImagen($nombreImagen)
    {
        if (!empty($_FILES)) {
            echo "Guardar";
            if (!is_dir('./ClienteEnojado')) {
                mkdir('./ClienteEnojado', 0777, true);
            }
            move_uploaded_file($_FILES['imagen']['tmp_name'], './ClienteEnojado/' . $nombreImagen . '.jpg');
        }
    }
}