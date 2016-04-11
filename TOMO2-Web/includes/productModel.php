<?php

class ProductModel
{
    private $pdo;

    public function __CONSTRUCT()
    {

        try {

            $this->pdo = new PDO('mysql:host=localhost;dbname=TOMO2', 'root', 'root');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function ListAll()
    {

        try {

            $result = array();

            $query = $this->pdo->prepare('SELECT * FROM Productos');
            $query->execute();

            foreach ($query->fetchAll(PDO::FETCH_OBJ) as $r) {

                $prdt = new Product();

                $prdt->__SET('id_product'   , $r->id_product);
                $prdt->__SET('name'         , $r->name);
                $prdt->__SET('description'  , $r->description);
                $prdt->__SET('category'     , $r->category);
                $prdt->__SET('subcategory'  , $r->subcategory);
                $prdt->__SET('image'        , $r->image);
                $prdt->__SET('active'       , $r->active);

                $result[] = $prdt;

            }

            return $result;

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function Obtain($id_product)
    {

        try {

            $query = $this->pdo->prepare('SELECT * FROM Productos WHERE id_product = ?');

            $query->execute(array($id_product));
            $r = $query->fetch(PDO::FETCH_OBJ);

            $prdt = new Product();

            $prdt->__SET('id_product'   , $r->id_product);
            $prdt->__SET('name'         , $r->name);
            $prdt->__SET('description'  , $r->description);
            $prdt->__SET('category'     , $r->category);
            $prdt->__SET('subcategory'  , $r->subcategory);
            $prdt->__SET('image'        , $r->image);
            $prdt->__SET('active'       , $r->active);

            return $prdt;

        } catch (Exception $e) {

            die ($e->getMessage());

        }

    }

    public function Delete($id_product)
    {

        try {

            $query = $this->pdo->prepare('DELETE FROM Productos WHERE id_product = ?');

            $query->execute(array($id_product));

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function Update(Product $data)
    {

        try {

            $query = "UPDATE Productos SET
                            name        = ?,
                            description = ?,
                            category    = ?,
                            subcategory = ?,
                            image       = ?,
                            active      = ?
                      WHERE id_product  = ?";

            $this->pdo->prepare($query)->execute(
                array(
                    $data->__GET('name'),
                    $data->__GET('description'),
                    $data->__GET('category'),
                    $data->__GET('subcategory'),
                    $data->__GET('image'),
                    $data->__GET('active'),
                    $data->__GET('id_product')
                )
            );

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function Insert(Product $data)
    {

        try {

            $query = "INSERT INTO Productos (name, description, category, subcategory, image, active)
                          VALUES (?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($query)->execute(
                array(
                    $data->__GET('name'),
                    $data->__GET('description'),
                    $data->__GET('category'),
                    $data->__GET('subcategory'),
                    $data->__GET('image'),
                    $data->__GET('active')
                )
            );

        } catch (Exception $e) {

            die ($e->getMessage());

        }

    }

}

?>