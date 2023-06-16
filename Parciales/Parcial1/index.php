<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo "Recibi GET" . PHP_EOL;
        if (!empty($_GET) && isset($_GET['request'])) {
            switch ($_GET['request']) {
                case 'HamburguesaConsultar':
                    include_once './controllers/HamburguesaConsultar.php';
                    break;
                case 'ConsultasVentas':
                    include_once './controllers/ConsultasVentas.php';
                    break;
                default:
                    echo 'Bad request';
                    break;
            }
        }
        break;
    case 'POST':
        echo "Recibi POST" . PHP_EOL;
        if (!empty($_POST) && isset($_POST['request'])) {
            switch ($_POST['request']) {
                case 'HamburguesaCarga':
                    include_once './controllers/HamburguesaCarga.php';
                    break;
                case 'AltaVenta':
                    include_once './controllers/AltaVenta.php';
                    break;
                case 'HamburguesaConsultar':
                    include_once './controllers/HamburguesaConsultar.php';
                    break;
                case 'HamburguesaDevolver':
                    include_once './controllers/DevolverHamburguesa.php';
                    break;
                default:
                    echo 'Bad request';
                    break;
            }
        }
        break;
    case 'PUT':
        echo "Recibi PUT" . PHP_EOL;
        $_PUT = file_get_contents('php://input');
        $_PUT = json_decode($_PUT, true);


        switch ($_PUT['request']) {
            case 'ModificarVenta':
                include_once './controllers/ModificarVenta.php';
                break;
            default:
                echo 'Bad request';
                break;
        }
        break;
    case 'DELETE':
        echo "Recibi DELETE" . PHP_EOL;
        $_DELETE = file_get_contents('php://input');
        $_DELETE = json_decode($_DELETE, true);
        switch ($_DELETE['request']) {
            case 'BorrarVenta':
                include_once './controllers/BorrarVenta.php';
                break;
            default:
                echo 'Bad request';
                break;
        }
        break;
    default:
        echo 'Metodo de REQUEST no definido';
        break;
}
