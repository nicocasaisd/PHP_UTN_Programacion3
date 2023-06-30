<?php
require_once './models/Sale.php';
require_once './interfaces/IApiUsable.php';

class SaleController extends Sale implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $id_coin = $parametros['id_coin'];
    $quantity = $parametros['quantity'];
    $jwt_data = AuthJWT::GetDataFromJWT($request);
    $id_user = $jwt_data->id_user;
    var_dump($id_user);

    // Creamos el sale
    $sale = new Sale();
    $sale->dateTimeString = DateTimeController::getNowAsMySQL();
    $sale->id_coin = $id_coin;
    $sale->quantity = $quantity;
    $sale->id_user = $id_user;
    $sale->createSale();

    $payload = json_encode(array("mensaje" => "Sale creado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  // public static function CargarDesdeCSV($sale)
  // {
  //   // Creamos el sale
  //   $newSale = new Sale();
  //   $newSale->dateTimeString = $sale['dateTimeString'];
  //   $newSale->id_coin = $sale['id_coin'];
  //   $newSale->quantity = $sale['quantity'];
  //   $newSale->id_bill = $sale['id_bill'];
  //   $newSale->id_waiter = $sale['id_waiter'];
  //   $newSale->id_cook = $sale['id_cook'];
  //   $newSale->status = $sale['status'];
  //   $newSale->preparationDateTimeString = $sale['preparationDateTimeString'];
  //   $newSale->subtotal = $sale['subtotal'];
  //   // var_dump($sale);

  //   $newSale->createSale();

  //   return $newSale;
  // }

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

  // public function ObtenerTiempoRestante($request, $response, $args)
  // {
  //   // Get params
  //   $parametros = $request->getQueryParams();
  //   $id_sale = $parametros['id_sale'];

  //   $sale = Sale::getSale($id_sale);

  //   if ($sale->status == "LISTA PARA SERVIR") {
  //     $payload = json_encode(array("mensaje" => "Su orden ya está lista."));
  //   } elseif ($sale->status == "PENDIENTE") {
  //     $payload = json_encode(array("mensaje" => "Su orden aún no ha sido recibida."));
  //   } else {
  //     try {
  //       $remainingMinutes = DateTimeController::getRemainingMinutes($sale->preparationDateTimeString);
  //       $payload = json_encode(array("mensaje" => $remainingMinutes));
  //     } catch (Exception $e) {
  //       // var_dump($e);
  //       $payload = json_encode(array("error" => $e->getMessage()));
  //     }
  //   }

  //   $response->getBody()->write($payload);
  //   return $response
  //     ->withHeader('Content-Type', 'application/json');
  // }
}
