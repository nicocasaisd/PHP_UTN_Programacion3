<?php

class ClaseDePrueba
{
    // Hacemos un getter general para todos los atributos
/*     public function __get($prop){
        if(property_exists($this, $prop)){
            return $this->userName;
        }
        else if(property_exists($this, $prop)){
            return $this->password;
        }
        else if(property_exists($this, $prop)){
            return $this->email;
        }
    } */

    // Otra version más generica
    public function __get($atributo) 
    {
        if (property_exists($this, $atributo)) 
        {
            return $this->$atributo;
        }
    }

    // Setter
    public function __set($atributo, $valor) 
    {
        if (property_exists($this, $atributo)) 
        {
          $this->$atributo = $valor;
        }
    }

}