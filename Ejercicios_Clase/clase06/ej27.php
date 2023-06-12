<?php

//echo 'Hola ' . $_POST["nombre"];

if(!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['clave']) && !empty($_POST['mail']))
{
    echo 'Hola';
}