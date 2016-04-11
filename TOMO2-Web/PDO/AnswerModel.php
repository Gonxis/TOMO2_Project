<?php

session_start();

include_once ('../includes/connection.php');
include_once ('../includes/Answer.php');

#if (isset($_SESSION['logged_in'])) {
class AnswerModel
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

    public function lastID()
    {
        try {

            $query = $this->pdo->prepare('SELECT MAX(id_event) AS idLast FROM concursos');
            $query->execute();

            $aux = $query->fetch(PDO::FETCH_ASSOC);

            $lastID = $aux['idLast'];

            return $lastID;

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function ListAll()
    {

        try {

            $result = array();

            $query = $this->pdo->prepare('SELECT * FROM Respuestas');
            $query->execute();

            foreach ($query->fetchAll(PDO::FETCH_OBJ) as $r) {

                $answer = new Answer();

                $answer->__SET('id_answer'     , $r->id_answer);
                $answer->__SET('id_event'      , $r->id_event);
                $answer->__SET('respuesta'     , $r->respuesta);
                $answer->__SET('correct'       , $r->correct);

                $result[] = $answer;

            }

            return $result;

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function Obtain($id_answer)
    {

        try {

            $query = $this->pdo->prepare('SELECT * FROM Respuestas WHERE id_answer = ?');

            $query->execute(array($id_answer));
            $r = $query->fetch(PDO::FETCH_OBJ);

            $answer = new Answer();

            $answer->__SET('id_answer'     , $r->id_answer);
            $answer->__SET('id_event'      , $r->id_event);
            $answer->__SET('respuesta'     , $r->respuesta);
            $answer->__SET('correct'       , $r->correct);

            return $answer;


        } catch (Exception $e) {

            die ($e->getMessage());

        }

    }

    public function Delete($id_answer)
    {

        try {

            $query = $this->pdo->prepare('DELETE FROM Respuestas WHERE id_answer = ?');

            $query->execute(array($id_answer));

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function Update(Answer $data)
    {

        try {

            $query = "UPDATE Respuestas SET
                            id_event       = ?,
                            respuesta      = ?,
                            correct        = ?,
                      WHERE id_answer      = ?";

            $this->pdo->prepare($query)->execute(
                array(
                    $data->__GET('id_event'),
                    $data->__GET('respuesta'),
                    $data->__GET('correct'),
                    $data->__GET('id_answer')
                )
            );

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function Insert(Answer $data)
    {

        try {

            $query = "INSERT INTO Respuestas (id_event, respuesta, correct)
                          VALUES (?, ?, ?)";

            $this->pdo->prepare($query)->execute(
                array(
                    $data->__GET('id_event'),
                    $data->__GET('respuesta'),
                    $data->__GET('correct')
                )
            );

        } catch (Exception $e) {

            die ($e->getMessage());

        }

    }

    public function InsertA($data) {

        $db = $this->pdo; // CONNECT

        //build the values
        $buildValues = '';
        if (is_array($data)) {
            //loop through all the fields
            foreach($data as $key => $value) {
                if ($key == 0) {
                    //first item
                    $buildValues .= '?';
                } else {
                    //every other item follows with a ","
                    $buildValues .= ', ?';
                }
            }
        } else {
            //we are only inserting one field
            $buildValues .= ':value';
        }

        $prepareInsert = $db->prepare('INSERT INTO Respuestas(id_event, respuesta, correct) VALUES ('.$buildValues.')');

        //execute the update for one or many values
        if (is_array($data)) {
            $prepareInsert->execute($data);
        } else {
            $prepareInsert->execute(array(':value' => $data));
        }
        //record and print any DB error that may be given
        $error = $prepareInsert->errorInfo();
        if ($error[1]) {
            print_r($error);
        } else {
            return true;
        }


//        // Use like this ->
//
//        // Change the line below to your timezone!
//        date_default_timezone_set('Europe/London');
//        $date = date('d-m-Y h:i:s a', time());
//
//        //inserting multiple items
//        $fields[] = 'forename';
//        $fields[] = 'surname';
//        $fields[] = 'email';
//        $fields[] = 'timestamp';
//
//        $values[] = "Rick";
//        $values[] = "Grimaldi";
//        $values[] = "rickygri@gmail.com";
//        $values[] = $date;
//
//
//        if($db->insert('users', $fields, $values)) {
//            echo "Success";
//        } else {
//            echo "Fail";
//        }

    }


}
