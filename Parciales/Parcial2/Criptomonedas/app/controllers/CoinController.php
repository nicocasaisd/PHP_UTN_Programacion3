<?php
require_once './models/Coin.php';
require_once './interfaces/IApiUsable.php';
require_once './controllers/FileController.php';

use GuzzleHttp\Psr7\LazyOpenStream;

class CoinController extends Coin implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $file = $request->getUploadedFiles();

    $name = $parametros['name'];
    $origin = $parametros['origin'];
    $price = $parametros['price'];
    $image = FileController::SaveImage($file, './media/cripto_images', $name . $origin);

    // Creamos el coin
    $coin = new Coin();
    $coin->name = $name;
    $coin->origin = $origin;
    $coin->image = $image;
    $coin->price = $price;
    $coin->createCoin();

    $payload = json_encode(array("mensaje" => "Coin creado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  // public static function CargarDesdeCSV($obj)
  // {
  //   // Creamos el order
  //   $newObject = new Coin();
  //   $newObject->name = $obj['name'];
  //   $newObject->origin = $obj['origin'];
  //   $newObject->price = $obj['price'];
  //   var_dump($obj);

  //   $newObject->createCoin();

  //   return $newObject;
  // }

  public function TraerUno($request, $response, $args)
  {
    // Buscamos user_name por nombre
    $id = $args['id_coin'];
    $coin = Coin::getCoin($id);
    $payload = json_encode($coin);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $list = Coin::getAll();
    $payload = json_encode(array('listOfCoins' => $list));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodosPorOrigin($request, $response, $args)
  {
    $origin = $args['origin'];
    $list = Coin::getAll();
    $listByOrigin = [];
    foreach ($list as $coin) {
      if ($coin->origin == $origin) {
        array_push($listByOrigin, $coin);
      }
    }

    $payload = json_encode(array('listOfCoins' => $listByOrigin));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodosPorNombre($request, $response, $args)
  {
    $name = $args['name'];
    $coin = Coin::getCoinByName($name);

    $payload = json_encode(array('coin' => $coin));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }


  public function ModificarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    if(Coin::getCoin($parametros['id']) == false){
      $payload = json_encode(array("error" => "No existe una Coin con la id pasada."));
      $response->withStatus(404);
    }
    else{
          // Creamos la Coin
          $coin = new Coin();
          $coin->id = $parametros['id'];
          $coin->name = $parametros['name'];
          $coin->origin =  $parametros['origin'];
          $coin->image = $parametros['image'];
          $coin->price = $parametros['price'];
      
          Coin::modifyCoin($coin);
          $payload = json_encode(array("mensaje" => "Coin modificado con exito"));

    }

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function BorrarUno($request, $response, $args)
  {
    $parametros = $request->getQueryParams();

    $id = $parametros['id'];
    $coin = Coin::getCoin($id);
    if (Coin::getCoin($id) != false) {
      Coin::deleteCoin($id);
      $payload = json_encode(array("mensaje" => "Coin borrado con exito", "coin" => $coin));
    } else {
      $payload = json_encode(array("error" => "No existe un coin con esa id"));
      $response = $response->withStatus(404);
    }

    $response->getBody()->write($payload);

    return $response
      ->withHeader('Content-Type', 'application/json');
  }


  public function DescargarCsv($request, $response, $args)
  {
    $list = Coin::getAll();

    // Creamos archivo en memoria
    $stream = fopen('php://memory', 'w+');
    foreach ($list as $line) {
      fputcsv($stream, get_object_vars($line), ',');
    }
    rewind($stream);

    $response->withHeader('Content-Type', 'text/csv');
    $response = $response->withHeader('Content-Disposition', 'attachment; filename="file.csv"');

    return $response
      ->withBody(new \Slim\Psr7\Stream($stream));
  }
}
