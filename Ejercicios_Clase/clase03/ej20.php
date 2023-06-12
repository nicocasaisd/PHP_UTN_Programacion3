<?php
/* 
Ej 20
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

    // Funcion Alta

/*     public function Alta(self $garage)
    {
        // Abrimos el archivo
        fopen("./garages.csv", "a");
        $strGarage = $garage->_razonSocial . "," . $garage->_precioPorHora  . "," . $garage->_autos;

    } */
}




