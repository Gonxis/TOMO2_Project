<?php

class Answer
{

    private $id_answer;
    private $id_event;
    private $answer;
    private $correct;

    /*public function __CONSTRUCT($id_answer, $id_event, $answer, $correct)
    {
        $this->id_answer = $id_answer;
        $this->id_event = $id_event;
        $this->answer = $answer;
        $this->correct = $correct;
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

        $query = $pdo->prepare ("SELECT * FROM Respuestas");
        $query->execute();

        return $query->fetchAll();
    }

}

?>