<?php

class Shop {

    private $id_shop;
    private $name;
    private $description;
    private $tel_number;
    private $iframe;
    private $image;
    private $active;

    /*public function __CONSTRUCT($id_shop, $name, $description, $tel_number, $iframe, $image, $active)
    {
        $this->id_shop = $id_shop;
        $this->name = $name;
        $this->description = $description;
        $this->tel_number = $tel_number;
        $this->iframe = $iframe;
        $this->image = $image;
        $this->active = $active;
    }*/

    public function __GET($k)
    {
        return $this->$k;
    }

    public function __SET($k, $v)
    {
        return $this->$k = $v;
    }

    public function fetch_all(){
        global $pdo;

        $query = $pdo->prepare ("SELECT * FROM Tiendas");
        $query->execute();

        return $query->fetchAll();
    }

}

?>