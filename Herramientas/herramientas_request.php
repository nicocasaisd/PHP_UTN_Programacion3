<?php


// SWITCH ENTRE REQUEST

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo "Recibi GET";
        break;
    case 'POST':
        echo "Recibi POST";

        break;
}

// VALIDACIONES DE POST

if (!empty($_POST)) {

    // VALIDACION DE EXISTENCIA
    if (isset($_POST['nombre']) && !empty($_POST['nombre'])) 
    {
        echo "El nombre esta definido"  . PHP_EOL;
    }

    // VALIDACIONES DE TIPO
    if ( is_numeric($_POST['edad']))
    {
        echo "La edad es numerica"  . PHP_EOL;
    }
}

// RECIBIR ARCHIVO POR POST
if(!empty($_FILES))
{
    move_uploaded_file($_FILES['perfil']['tmp_name'], './Usuario/Fotos/perfil'. $usuario->id.'.jpg');
}