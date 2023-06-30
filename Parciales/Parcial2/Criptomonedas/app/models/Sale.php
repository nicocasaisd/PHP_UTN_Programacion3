<?php

class Sale
{
    public $id;
    public $dateTimeString;
    public $id_coin;
    public $quantity;
    public $subtotal;


    //GETTER

    public function __get($atributo) 
    {
        if (property_exists($this, $atributo)) 
        {
            return $this->$atributo;
        }
    }

    // SETTER

    public function __set($atributo, $valor) 
    {
        if (property_exists($this, $atributo)) 
        {
          $this->$atributo = $valor;
        }
    }

    public function createSale()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO sales (dateTimeString, id_coin, quantity, subtotal) VALUES (:dateTimeString, :id_coin, :quantity, :subtotal)");
        $consulta->bindValue(':dateTimeString', $this->dateTimeString, PDO::PARAM_STR);
        $consulta->bindValue(':id_coin', $this->id_coin, PDO::PARAM_INT);
        $consulta->bindValue(':quantity', $this->quantity, PDO::PARAM_INT);
        $consulta->bindValue(':subtotal', $this->getSubtotal());
        $consulta->execute();


        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        // $consulta = $dataAccessObject->prepareQuery("SELECT id, dateTimeString, id_coin, quantity, id_bill, id_waiter, id_cook, status, preparationDateTimeString, subtotal FROM sales");
        $consulta = $dataAccessObject->prepareQuery("SELECT * FROM sales");
        $consulta->execute();

        // var_dump($consulta->fetchAll());

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Sale');
    }

    public static function getSale($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, dateTimeString, id_coin, quantity, id_bill, id_waiter, id_cook, status, preparationDateTimeString, subtotal FROM sales WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Sale');
    }

    public static function modifySale($sale)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE sales SET dateTimeString=:dateTimeString, id_coin=:id_coin, quantity=:quantity, id_bill=:id_bill, id_waiter=:id_waiter, id_cook=:id_cook, status=:status, preparationDateTimeString=:preparationDateTimeString, subtotal=:subtotal WHERE id = :id");
        $consulta->bindValue(':id', $sale->id, PDO::PARAM_INT);
        $consulta->bindValue(':dateTimeString', $sale->dateTimeString, PDO::PARAM_STR);
        $consulta->bindValue(':id_coin', $sale->id_coin, PDO::PARAM_INT);
        $consulta->bindValue(':quantity', $sale->quantity, PDO::PARAM_INT);
        $consulta->bindValue(':id_bill', $sale->id_bill, PDO::PARAM_INT);
        $consulta->bindValue(':id_waiter', $sale->id_waiter, PDO::PARAM_INT);
        $consulta->bindValue(':id_cook', $sale->id_cook, PDO::PARAM_INT);
        $consulta->bindValue(':status', $sale->status, PDO::PARAM_STR);
        $consulta->bindValue(':preparationDateTimeString', $sale->preparationDateTimeString, PDO::PARAM_STR);
        $consulta->bindValue(':subtotal', $sale->subtotal);
        $consulta->execute();
    }

    public static function deleteSale($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("DELETE sales WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }

    public function getSubtotal()
    {
        $price = Coin::getCoin($this->id_product)->price;

        return $price * $this->quantity;
    }
}