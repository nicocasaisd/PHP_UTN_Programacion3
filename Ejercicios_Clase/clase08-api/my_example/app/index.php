<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world en APP");
    return $response->withAddedHeader('Hago', 'loquemepinta');
});

$app->get('/middleware', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Middleware");
    return $response;
});



$app->run();
