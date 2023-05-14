<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo "Recibi GET" . PHP_EOL;
        if (!empty($_GET) && isset($_GET['request'])) {
            switch ($_GET['request']) {
                case 'PizzaConsultar':
                    include_once './PizzaConsultar.php';
                    break;
                case 'ConsultasVentas':
                    include_once './ConsultasVentas.php';
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
                case 'PizzaCarga':
                    include_once './PizzaCarga.php';
                    break;
                case 'AltaVenta':
                    include_once './AltaVenta.php';
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
                include_once './ModificarVenta.php';
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
