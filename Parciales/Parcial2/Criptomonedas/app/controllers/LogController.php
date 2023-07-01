<?php
require_once './models/Log.php';
require_once './interfaces/IApiUsable.php';

class LogController
{
  public static function CargarUno($request, $action)
  {
    $parametros = $request->getQueryParams();

    $id_coin = $parametros['id'];
    $jwt_data = AuthJWT::GetDataFromJWT($request);
    $id_user = $jwt_data->id_user;

    // Creamos el log
    $log = new Log();
    $log->dateTimeString = DateTimeController::getNowAsMySQL();
    $log->id_coin = $id_coin;
    $log->id_user = $id_user;
    $log->action = $action;

    $log->createLog();

    $payload = json_encode(array("mensaje" => "Log creado con exito"));

  }


  public function TraerUno($request, $response, $args)
  {
    // Buscamos user_name por nombre
    $id = $args['id_log'];
    $log = Log::getLog($id);
    $payload = json_encode($log);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $list = Log::getAll();
    $payload = json_encode(array('listOfLogs' => $list));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function ModificarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $nombre = $parametros['nombre'];
    Log::modifyLog($nombre);

    $payload = json_encode(array("mensaje" => "Log modificado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function BorrarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $id = $parametros['id'];
    Log::deleteLog($id);

    $payload = json_encode(array("mensaje" => "Log borrado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodosPorOriginYFecha($request, $response, $args)
  {
    $parametros = $request->getQueryParams();
    $origin = $parametros['origin'];
    $fecha_inicio = DateTime::createFromFormat('d-m-y', $parametros['fecha_inicio']);
    $fecha_final = DateTime::createFromFormat('d-m-y', $parametros['fecha_final']);

    $list = Log::getAll();
    $listByOrigin = [];
    foreach ($list as $log) {

      $dateTime = DateTimeController::MySQLToDateTime($log->dateTimeString);
      $logOrigin = Coin::getCoin($log->id_coin)->origin;
      if (
        $logOrigin == $origin
        &&  $dateTime >= $fecha_inicio 
        &&  $dateTime <= $fecha_final
      ) {
        array_push($listByOrigin, $log);
      }
    }


    $payload = json_encode(array('listOfLogs' => $listByOrigin));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
}
