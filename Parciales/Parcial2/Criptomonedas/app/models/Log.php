<?php

class Log
{
    public $id;
    public $dateTimeString;
    public $id_coin;
    public $id_user;
    public $action;


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

    public function createLog()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO logs (dateTimeString, id_coin, id_user, action) VALUES (:dateTimeString, :id_coin, :id_user, :action)");
        $consulta->bindValue(':dateTimeString', $this->dateTimeString, PDO::PARAM_STR);
        $consulta->bindValue(':id_coin', $this->id_coin, PDO::PARAM_INT);
        $consulta->bindValue(':id_user', $this->id_coin, PDO::PARAM_INT);
        $consulta->bindValue(':action', $this->action, PDO::PARAM_STR);
        $consulta->execute();


        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT * FROM logs");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Log');
    }

    public static function getLog($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT * FROM logs WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Log');
    }

    public static function modifyLog($log)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE logs SET dateTimeString=:dateTimeString, id_coin=:id_coin,  id_user=:id_user,quantity=:quantity, subtotal=:subtotal WHERE id = :id");
        $consulta->bindValue(':id', $log->id, PDO::PARAM_INT);
        $consulta->bindValue(':dateTimeString', $log->dateTimeString, PDO::PARAM_STR);
        $consulta->bindValue(':id_coin', $log->id_coin, PDO::PARAM_INT);
        $consulta->bindValue(':id_user', $log->id_coin, PDO::PARAM_INT);
        $consulta->bindValue(':quantity', $log->quantity, PDO::PARAM_INT);
        $consulta->bindValue(':subtotal', $log->getSubtotal());
        $consulta->execute();
    }

    public static function deleteLog($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("DELETE logs WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }
}