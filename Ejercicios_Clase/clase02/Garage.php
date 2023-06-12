<?php
/* 
Aplicación Nº 18 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:
_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
Realizar un constructor capaz de poder instanciar objetos pasándole como
parámetros: i. La razón social.
ii. La razón social, y el precio por hora.
Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
que mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo). Ejemplo:
$miGarage->Remove($autoUno);

CASAIS DASSIE, NICOLAS
*/

include "./Auto.php";

class Garage
{
    private string $_razonSocial;
    private float $_precioPorHora;
    private $_autos;

    // CONSTRUCTOR
    public function __construct($_razonSocial, $_precioPorHora = null)
    {
        $this->_razonSocial = $_razonSocial;
        $this->_precioPorHora = $_precioPorHora;
        $this->_autos = [];
    }

    //GETTER GRAL
    public function __get($atributo)
    {
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }

    public function MostrarGarage()
    {
        echo "Razon social: " . $this->_razonSocial . "<br/>";
        echo "Precio por hora: " . $this->_precioPorHora . "<br/>";

        foreach ($this->_autos as $_elemento) {
            Auto::MostrarAuto($_elemento);
        }
    }

    public function Add(Auto $auto)
    {
        if (in_array($auto, $this->_autos)) {
            echo "El auto ya existe en el garage. <br/>";
        } else {
            array_push($this->_autos, $auto);
            echo "Auto agregado al garage. <br/>";
        }
    }

    public function Remove(Auto $auto)
    {
        if (!in_array($auto, $this->_autos)) {
            echo "El auto NO  existe en el garage. <br/>";
        } else {
            $index = array_search($auto, $this->_autos, true);
            array_splice($this->_autos, $index, 1);
            echo "Se removio el auto del garage. <br/>";
        }
    }

    public function Equals(Auto $autoAComparar)
    {
        foreach ($this->_autos as $_auto) {
            if ($_auto == $autoAComparar) {
                return true;
            }
        }
        return false;
    }
}
