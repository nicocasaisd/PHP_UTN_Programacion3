<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

require_once './db/DataAccess.php';
// require_once './middlewares/Logger.php';


require_once './controllers/UserController.php';
require_once './controllers/LoginController.php';
require_once './controllers/CoinController.php';

// Middlewares
require_once './middlewares/AuthorizationMW.php';

// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Routes

// Login
$app->post('/login', \LoginController::class . ':ValidateLogin');

// Users
$app->group('/users', function (RouteCollectorProxy $group) {
  $group->get('[/]', \UserController::class . ':TraerTodos');
  $group->get('/{user}', \UserController::class . ':TraerUno');
  $group->post('[/]', \UserController::class . ':CargarUno');
})
  ->add(\AuthorizationMW::class . ':ValidateAdmin')
  ->add(\AuthorizationMW::class . ':ValidateToken');

// Coins
$app->group('/coins', function (RouteCollectorProxy $group) {
  $group->get('/all', \CoinController::class . ':TraerTodos');
  $group->get('[/origin/{origin}]', \CoinController::class . ':TraerTodosPorOrigin');
  $group->get('/id/{id_coin}', \CoinController::class . ':TraerUno');
  $group->post('[/]', \CoinController::class . ':CargarUno');
})
  ->add(\AuthorizationMW::class . ':ValidateAdmin')
  ->add(\AuthorizationMW::class . ':ValidateToken');



//Tests
$app->get('[/]', function (Request $request, Response $response) {
  $payload = json_encode(array("mensaje" => "Slim Framework 4 PHP"));

  $response->getBody()->write($payload);
  return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
