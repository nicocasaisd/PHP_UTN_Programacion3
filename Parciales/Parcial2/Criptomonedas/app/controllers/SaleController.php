<?php
require_once './models/Sale.php';
require_once './interfaces/IApiUsable.php';

class SaleController extends Sale implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $file = $request->getUploadedFiles();

    $id_coin = $parametros['id_coin'];
    $quantity = $parametros['quantity'];
    $jwt_data = AuthJWT::GetDataFromJWT($request);
    $id_user = $jwt_data->id_user;

    // Creamos el sale
    $sale = new Sale();
    $sale->dateTimeString = DateTimeController::getNowAsMySQL();
    $sale->id_coin = $id_coin;
    $sale->quantity = $quantity;
    $sale->id_user = $id_user;
    // Save Image
    $coin_name = Coin::getCoin($id_coin)->name;
    $now = new DateTime();
    $filename = $coin_name . $jwt_data->user . $now->format('ymd');
    $image = FileController::SaveImage($file, './media/FotosCripto2023', $filename);

    $sale->image = $image;
    $sale->createSale();

    $payload = json_encode(array("mensaje" => "Sale creado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }


  public function TraerUno($request, $response, $args)
  {
    // Buscamos user_name por nombre
    $id = $args['id_sale'];
    $sale = Sale::getSale($id);
    $payload = json_encode($sale);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $list = Sale::getAll();
    // var_dump($list);
    $payload = json_encode(array('listOfSales' => $list));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function ModificarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $nombre = $parametros['nombre'];
    Sale::modifySale($nombre);

    $payload = json_encode(array("mensaje" => "Sale modificado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function BorrarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $id = $parametros['id'];
    Sale::deleteSale($id);

    $payload = json_encode(array("mensaje" => "Sale borrado con exito"));

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

    $list = Sale::getAll();
    $listByOrigin = [];
    foreach ($list as $sale) {

      $dateTime = DateTimeController::MySQLToDateTime($sale->dateTimeString);
      $saleOrigin = Coin::getCoin($sale->id_coin)->origin;
      if (
        $saleOrigin == $origin
        &&  $dateTime >= $fecha_inicio
        &&  $dateTime <= $fecha_final
      ) {
        array_push($listByOrigin, $sale);
      }
    }
    $payload = json_encode(array('listOfSales' => $listByOrigin));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerClientesPorMoneda($request, $response, $args)
  {
    $name = $args['name'];
    $sales = Sale::getAll();
    $coin = Coin::getCoinByName($name);
    $clientsOfCoin = [];
    foreach ($sales as $sale) {
      if ($sale->id_coin == $coin->id) {
        array_push($clientsOfCoin, $sale);
      }
    }

    $payload = json_encode(array('Coin' => $coin->name ,'salesOfCoin' => $clientsOfCoin));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
}
