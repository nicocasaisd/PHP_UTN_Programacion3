<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

include_once './middlewares/AuthJWT.php';
include_once './controllers/LogController.php';

class DeletionLogger
{
    public function LogAction(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);
        var_dump($response->getStatusCode());
        if($response->getStatusCode() == 200){
            LogController::CargarUno($request, 'borrado');
            $response->getBody()->write("Se ha generado el log.");
        }

        return $response;
    }


}
