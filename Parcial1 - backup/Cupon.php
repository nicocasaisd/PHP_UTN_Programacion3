<?php

// Clase Cupon

Class Cupon
{
    public int $id;
    public int $devolucion_id;
    public float $porcentajeDescuento;
    public bool $estado;

    public function __construct($id, $devolucion_id, $porcentajeDescuento)
    {
        $this->id = rand(20000, 30000);
        //$this->devolucion_id = 0;
        $this->porcentajeDescuento = $porcentajeDescuento;
        $this->estado = true;
        
    }


}