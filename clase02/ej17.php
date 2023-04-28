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
    private ?float $_precio;
    private string $_marca;
    private ?DateTime $_fecha;

    public function __construct(string $_marca, string $_color, ?float $_precio = null, ?DateTime $_fecha = null)
    {
        echo 'En el constructor de auto';
        $this->_color = $_color;
        $this->_marca = $_marca;
        $this->_precio = $_precio;
        $this->_fecha = $_fecha;
    }

    public function __get($atributo) 
    {
        if (property_exists($this, $atributo)) 
        {
            return $this->$atributo;
        }
    }
}

$auto2 = new Auto('Chevrolet CELTA', 'Gris', 100, new DateTime());
$auto = new Auto('Chevrolet ONIX', 'Gris');

echo '<br/> Auto color: ', $auto->_color;
echo '<br/> Auto2 marca: ', $auto2->__get('_marca');
echo '<br>tipo de DateTime: ', gettype($auto2->_fecha);
echo '<br>tipo de precio: ', gettype($auto2->_precio);
echo '<br>tipo de precio: ', gettype($auto->_precio);
