<?php

class Product {
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
