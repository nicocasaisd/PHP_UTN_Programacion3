<?php

/* 
Ejercicio 19


CASAIS DASSIE, NICOLAS  
*/

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
        if ($auto1->Equals($auto2) && $auto1->_color == $auto2->_color) {
            return $auto1->_precio +  $auto2->_precio;
        }
        return 0;
    }

    /* 
Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
autos.csv.
*/

    public static function Alta(self $auto1)
    {
        // Abrimos el archivo
        $archivo = fopen("./autos.csv", "a");
        //$strAuto = $auto1->__get("_marca") . "\n";
        $strAuto = $auto1->_marca . "," . $auto1->_color . "," . $auto1->_precio . "," . $auto1->_fecha->format("d/m/y") .  PHP_EOL;
        fputs($archivo, $strAuto);
    }

    

    public static function LeerDeArchivo(string $path)
    {
        // Creamos un array vacio
        $arrayDeAutos = [];
        // Abrimos
        $archivo = fopen($path, "r");

        // Leemos por linea
        while (!feof($archivo)) {
            $line = fgets($archivo);
            if ($line != null) {
                $array = str_getcsv($line, ",");
                var_dump($array);
                $date = DateTime::createFromFormat("d/m/y", $array[3]);
                if($date == false)
                {
                    echo "Ocurrio un error";
                }
            }
        }
        return $arrayDeAutos;
    }
}

echo '<h3> Funcion static Alta() </h3>';

$auto1 = new Auto('Peugeot', 'Gris', 10000, new DateTime());

//Auto::Alta($auto1);

echo '<h3> Funcion LeerDeArchivo() </h3>';

$arrayDeAutos = Auto::LeerDeArchivo("./autos.csv");

echo '<h4> Array </h4>';
var_dump($arrayDeAutos);
