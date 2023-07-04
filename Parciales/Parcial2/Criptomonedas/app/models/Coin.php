<?php

class Coin
{
    public $id;
    public $name;
    public $origin;
    public $image;
    public $price;


    //GETTER

    public function __get($atributo)
    {
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }

    // SETTER

    public function __set($atributo, $valor)
    {
        if (property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }

    public function createCoin()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO coins (name, origin, image,  price) VALUES (:name, :origin, :image,:price)");
        $consulta->bindValue(':name', $this->name, PDO::PARAM_STR);
        $consulta->bindValue(':origin', $this->origin, PDO::PARAM_STR);
        $consulta->bindValue(':image', $this->image, PDO::PARAM_STR);
        $consulta->bindValue(':price', $this->price);
        $consulta->execute();

        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, name, origin, image, price FROM coins");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Coin');
    }

    public static function getCoin($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, name, origin, image, price FROM coins WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Coin');
    }

    public static function getCoinByName($name)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, name, origin, image, price FROM coins WHERE name = :name");
        $consulta->bindValue(':name', $name, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Coin');
    }

    public static function modifyCoin($coin)
    {
        // var_dump($coin);
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE coins SET name = :name, price = :price, origin = :origin, image = :image WHERE id = :id");
        $consulta->bindValue(':id', $coin->id, PDO::PARAM_INT);
        $consulta->bindValue(':name', $coin->name, PDO::PARAM_STR);
        $consulta->bindValue(':origin', $coin->origin, PDO::PARAM_STR);
        $consulta->bindValue(':image', $coin->image, PDO::PARAM_STR);
        $consulta->bindValue(':price', $coin->price, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function deleteCoin($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("DELETE FROM coins WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }
}
