<?php

session_start();

include_once ('../includes/connection.php');
include_once ('../includes/Contest.php');

#if (isset($_SESSION['logged_in'])) {
    class ContestModel
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

                $query = $this->pdo->prepare('SELECT * FROM Concursos');
                $query->execute();

                foreach ($query->fetchAll(PDO::FETCH_OBJ) as $r) {

                    $contest = new Contest();

                    $contest->__SET('id_event'     , $r->id_event);
                    $contest->__SET('id_type'      , $r->id_type);
                    $contest->__SET('name'         , $r->name);
                    $contest->__SET('question'     , $r->question);
                    $contest->__SET('initial_date' , $r->initial_date);
                    $contest->__SET('final_date'   , $r->final_date);
                    $contest->__SET('winner'       , $r->winner);
                    $contest->__SET('active'       , $r->active);

                    $result[] = $contest;

                }

                return $result;

            } catch (Exception $e) {

                die ($e->getMessage());

            }
        }

        public function Obtain($id_event)
        {

            try {

                $query = $this->pdo->prepare('SELECT * FROM Concursos WHERE id_event = ?');

                $query->execute(array($id_event));
                $r = $query->fetch(PDO::FETCH_OBJ);

                $contest = new Contest();

                $contest->__SET('id_event'     , $r->id_event);
                $contest->__SET('id_type'      , $r->id_type);
                $contest->__SET('name'         , $r->name);
                $contest->__SET('question'     , $r->question);
                $contest->__SET('initial_date' , $r->initial_date);
                $contest->__SET('final_date'   , $r->final_date);
                $contest->__SET('winner'       , $r->winner);
                $contest->__SET('active'       , $r->active);

                return $contest;

            } catch (Exception $e) {

                die ($e->getMessage());

            }

        }

        public function Delete($id_event)
        {

            try {

                $query = $this->pdo->prepare('DELETE FROM Concursos WHERE id_event = ?');

                $query->execute(array($id_event));

            } catch (Exception $e) {

                die ($e->getMessage());

            }
        }

        public function Update(Contest $data)
        {

            try {

                $query = "UPDATE Concursos SET
                            id_type       = ?,
                            name          = ?,
                            question      = ?,
                            initial_date  = ?,
                            final_date    = ?,
                            winner        = ?,
                            active        = ?
                      WHERE id_event      = ?";

                $this->pdo->prepare($query)->execute(
                    array(
                        $data->__GET('id_type'),
                        $data->__GET('name'),
                        $data->__GET('question'),
                        $data->__GET('initial_date'),
                        $data->__GET('final_date'),
                        $data->__GET('winner'),
                        $data->__GET('active'),
                        $data->__GET('id_event')
                    )
                );

            } catch (Exception $e) {

                die ($e->getMessage());

            }
        }

        public function Insert(Contest $data)
        {

            try {

                $query = "INSERT INTO Concursos (id_type, name, question, initial_date, final_date, winner, active)
                          VALUES (?, ?, ?, ?, ?, ?, ?)";

                $this->pdo->prepare($query)->execute(
                    array(
                        $data->__GET('id_type'),
                        $data->__GET('name'),
                        $data->__GET('question'),
                        $data->__GET('initial_date'),
                        $data->__GET('final_date'),
                        $data->__GET('winner'),
                        $data->__GET('active')
                    )
                );

            } catch (Exception $e) {

                die ($e->getMessage());

            }

        }

    }
