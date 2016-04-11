<?php

class Product {

    private $id_product;
    private $name;
    private $description;
    private $category;
    private $subcategory;
    private $image;
    private $active;

    public function __CONSTRUCT($id_product, $name, $description, $category, $subcategory, $image, $active)
    {
        $this->id_product = $id_product;
        $this->name = $name;
        $this->description = $name;
        $this->category = $category;
        $this->subcategory = $subcategory;
        $this->image = $image;
        $this->active = $active;
    }

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

        $query = $pdo->prepare ("SELECT * FROM Productos");
        $query->execute();

        return $query->fetchAll();
    }

    public function fetch_data($id_product){
        global $pdo;

        $query = $pdo->prepare ("SELECT * FROM Productos WHERE id_product = ?");
        $query->bindValue (1, $id_product);
        $query->execute();

        return $query->fetch();
    }
}

?>
