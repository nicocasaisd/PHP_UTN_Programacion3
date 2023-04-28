<?php
/*  
Aplicación Nº 17 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos
privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)
*/

//      *** CLASE ***

class Auto
{
    public string $_color;
    private ?float $_precio;
    private string $_marca;
    private ?DateTime $_fecha;

    public function __construct(string $_marca, string $_color, ?float $_precio = null, ?DateTime $_fecha = null)
    {
        //echo 'En el constructor de auto';
        $this->_color = $_color;
        $this->_marca = $_marca;
        $this->_precio = $_precio;
        $this->_fecha = $_fecha;
    }

    public function __get($atributo)
    {
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }

    public function AgregarImpuestos(float $impuesto)
    {
        echo '<br>Sumamos impuesto';
        $this->_precio += $impuesto;
    }

    public static function MostrarAuto(self $auto)
    {

        echo 'Marca: ' . $auto->_marca . '<br>';
        echo 'Color: ' . $auto->_color . '<br>';
        echo 'Precio: ' . $auto->_precio . '<br>';
        if (!is_null($auto->_fecha)) {
            echo 'Fecha: ' . $auto->_fecha->format('d/m/y') . '<br>';
        } else {
            echo 'Fecha: INDEFINIDA' . '<br>';
        }
    }

    public function Equals(self $auto_a_comparar)
    {
        return $this->_marca == $auto_a_comparar->_marca;
    }

    public static function Add(self $auto1, self $auto2)
    {
        if($auto1->Equals($auto2) && $auto1->_color == $auto2->_color){
            return $auto1->_precio +  $auto2->_precio;
        }
        return 0;
    }
}

//      *** CONSOLA ***

$date = new DateTime();
echo 'Fecha: ' . $date->format('d/m/y') . '<br>';
$auto1 = new Auto('CELTA', 'Gris', 100, $date);
$auto2 = new Auto('CELTA', 'Gris', 80);

// echo '<br/> Auto color: ', $auto_1->_color;
// echo '<br/> Auto2 marca: ', $auto2->__get('_marca');
// echo '<br>tipo de DateTime: ', gettype($auto2->_fecha);
// echo '<br>tipo de precio: ', gettype($auto2->_precio);
// echo '<br>tipo de precio: ', gettype($auto->_precio);
//echo '<br/> Auto precio: ', $auto_1->_precio;

Auto::MostrarAuto($auto1);
Auto::MostrarAuto($auto2);
$auto1->AgregarImpuestos(20);
echo '<br/> Auto precio con impuesto: ', $auto1->_precio;

echo '<br/> Equals: ';
echo $auto1->Equals($auto2);
 echo '<br/> Add: ' . Auto::Add($auto1, $auto2);
