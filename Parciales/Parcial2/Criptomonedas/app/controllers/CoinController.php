<?php
require_once './models/Coin.php';
require_once './interfaces/IApiUsable.php';
require_once './controllers/FileController.php';

class CoinController extends Coin implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $file = $request->getUploadedFiles();
        
        $name = $parametros['name'];
        $origin = $parametros['origin'];
        $price = $parametros['price'];
        $image = FileController::SaveImage($file, './media/cripto_images', $name.$origin);
        
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
        $id = $args['dish_id'];
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
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        Coin::modifyCoin($nombre);

        $payload = json_encode(array("mensaje" => "Coin modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $parametros['id'];
        Coin::deleteCoin($id);

        $payload = json_encode(array("mensaje" => "Coin borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
