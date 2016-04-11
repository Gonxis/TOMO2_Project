<?php

session_start();

include_once ('../includes/connection.php');
include_once ('../includes/New.php');

//if (isset($_SESSION['logged_in'])) {
    class NewModel
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

                $query = $this->pdo->prepare('SELECT * FROM Noticias');
                $query->execute();

                foreach ($query->fetchAll(PDO::FETCH_OBJ) as $r) {

                    $news = new News();

                    $news->__SET('id_news'      , $r->id_news);
                    $news->__SET('name'         , $r->name);
                    $news->__SET('description'  , $r->description);
                    $news->__SET('upload_date'  , $r->upload_date);
                    $news->__SET('image'        , $r->image);
                    $news->__SET('link'         , $r->link);
                    $news->__SET('active'       , $r->active);

                    $result[] = $news;

                }

                return $result;

            } catch (Exception $e) {

                die ($e->getMessage());

            }
        }

        public function Obtain($id_news)
        {

            try {

                $query = $this->pdo->prepare('SELECT * FROM Noticias WHERE id_news = ?');

                $query->execute(array($id_news));
                $r = $query->fetch(PDO::FETCH_OBJ);

                $news = new News();

                $news->__SET('id_news'      , $r->id_news);
                $news->__SET('name'         , $r->name);
                $news->__SET('description'  , $r->description);
                $news->__SET('upload_date'  , $r->upload_date);
                $news->__SET('image'        , $r->image);
                $news->__SET('link'         , $r->link);
                $news->__SET('active'       , $r->active);

                return $news;

            } catch (Exception $e) {

                die ($e->getMessage());

            }

        }

        public function Delete($id_news)
        {

            try {

                $query = $this->pdo->prepare('DELETE FROM Noticias WHERE id_news = ?');

                $query->execute(array($id_news));

            } catch (Exception $e) {

                die ($e->getMessage());

            }
        }

        public function Update(News $data)
        {

            try {

                $query = "UPDATE Noticias SET
                            name          = ?,
                            description   = ?,
                            upload_date   = ?,
                            active        = ?,
                            link          = ?,
                            active        = ?
                      WHERE id_news       = ?";

                $this->pdo->prepare($query)->execute(
                    array(
                        $data->__GET('name'),
                        $data->__GET('description'),
                        $data->__GET('upload_date'),
                        $data->__GET('image'),
                        $data->__GET('link'),
                        $data->__GET('active'),
                        $data->__GET('id_news')
                    )
                );

            } catch (Exception $e) {

                die ($e->getMessage());

            }
        }

        public function Insert(News $data)
        {

            try {

                $query = "INSERT INTO Noticias (name, description, upload_date, image, link, active)
                          VALUES (?, ?, ?, ?, ?, ?)";

                $this->pdo->prepare($query)->execute(
                    array(
                        $data->__GET('name'),
                        $data->__GET('description'),
                        $data->__GET('upload_date'),
                        $data->__GET('image'),
                        $data->__GET('link'),
                        $data->__GET('active')
                    )
                );

            } catch (Exception $e) {

                die ($e->getMessage());

            }

        }

    }

    ?>