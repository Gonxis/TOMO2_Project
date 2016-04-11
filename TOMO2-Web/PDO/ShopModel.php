<?php

session_start();

include_once ('../includes/connection.php');
include_once ('../includes/Shop.php');

    class ShopModel
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

                $query = $this->pdo->prepare('SELECT * FROM Tiendas');
                $query->execute();

                foreach ($query->fetchAll(PDO::FETCH_OBJ) as $r) {

                    $shop = new Shop();

                    $shop->__SET('id_shop', $r->id_shop);
                    $shop->__SET('name', $r->name);
                    $shop->__SET('description', $r->description);
                    $shop->__SET('tel_number', $r->tel_number);
                    $shop->__SET('iframe', $r->iframe);
                    $shop->__SET('image', $r->image);
                    $shop->__SET('active', $r->active);

                    $result[] = $shop;

                }

                return $result;

            } catch (Exception $e) {

                die ($e->getMessage());

            }
        }

        public function Obtain($id_shop)
        {

            try {

                $query = $this->pdo->prepare('SELECT * FROM Tiendas WHERE id_shop = ?');

                $query->execute(array($id_shop));
                $r = $query->fetch(PDO::FETCH_OBJ);

                $shop = new Shop();

                $shop->__SET('id_shop', $r->id_shop);
                $shop->__SET('name', $r->name);
                $shop->__SET('description', $r->description);
                $shop->__SET('tel_number', $r->tel_number);
                $shop->__SET('iframe', $r->iframe);
                $shop->__SET('image', $r->image);
                $shop->__SET('active', $r->active);

                return $shop;

            } catch (Exception $e) {

                die ($e->getMessage());

            }

        }

        public function Delete($id_shop)
        {

            try {

                $query = $this->pdo->prepare('DELETE FROM Tiendas WHERE id_shop = ?');

                $query->execute(array($id_shop));

            } catch (Exception $e) {

                die ($e->getMessage());

            }
        }

        public function Update(Shop $data)
        {

            try {

                $query = "UPDATE Tiendas SET
                            name        = ?,
                            description = ?,
                            tel_number  = ?,
                            iframe      = ?,
                            image       = ?,
                            active      = ?
                      WHERE id_shop     = ?";

                $this->pdo->prepare($query)->execute(
                    array(
                        $data->__GET('name'),
                        $data->__GET('description'),
                        $data->__GET('tel_number'),
                        $data->__GET('iframe'),
                        $data->__GET('image'),
                        $data->__GET('active'),
                        $data->__GET('id_shop')
                    )
                );

            } catch (Exception $e) {

                die ($e->getMessage());

            }
        }

        public function Insert(Shop $data)
        {

            try {

                $query = "INSERT INTO Tiendas (name, description, tel_number, iframe, image, active)
                      VALUES (?, ?, ?, ?, ?, ?)";

                $this->pdo->prepare($query)->execute(
                    array(
                        $data->__GET('name'),
                        $data->__GET('description'),
                        $data->__GET('tel_number'),
                        $data->__GET('iframe'),
                        $data->__GET('image'),
                        $data->__GET('active')
                    )
                );

            } catch (Exception $e) {

                die ($e->getMessage());

            }

        }

    }

