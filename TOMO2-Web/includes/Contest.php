<?php

class Contest
{

    private $id_event;
    private $id_type;
    private $name;
    private $question;
    private $initial_date;
    private $final_date;
    private $winner;
    private $active;

    /*public function __CONSTRUCT($id_event, $id_type, $name, $question, $initial_date, $final_date, $winner, $active)
    {
        $this->id_event = $id_event;
        $this->id_type = $id_type;
        $this->name = $name;
        $this->question = $question;
        $this->initial_date = $initial_date;
        $this->final_date = $final_date;
        $this->winner = $winner;
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

        $query = $pdo->prepare ("SELECT * FROM Concursos");
        $query->execute();

        return $query->fetchAll();
    }

}

?>