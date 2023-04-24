<?php
/*  
Aplicación Nº 17 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos
privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)
*/

class Auto
{
    public string $_color;
    private float $_precio;
    private string $_marca;
    private DateTime $_fecha;

    public function __construct(string $_marca, string $_color, float $_precio, DateTime $_fecha)
    {
        echo 'En el constructor de auto';
        $this->_color = $_color;
        $this->_marca = $_marca;
        $this->_precio = $_precio;
        $this->_fecha = $_fecha;
    }

}

$auto = new Auto('Chevrolet CELTA', 'Gris', 100, new DateTime());

echo '<br/> Auto color: ',$auto->_color;