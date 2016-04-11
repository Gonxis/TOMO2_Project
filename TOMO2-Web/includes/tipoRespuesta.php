<?php

class TipoRespuesta
{

    private $id_type;
    private $tipo;

    /*public function __CONSTRUCT($id_type, $tipo)
    {
        $this->id_type = $id_type;
        $this->tipo = $tipo;

    }*/

    public function __GET($k)
    {
        return $this-> $k;
    }

    public function __SET($k, $v)
    {
        return $this-> $k = $v;
    }

    public function fetch_all(){
        global $pdo;

        $query = $pdo->prepare ("SELECT * FROM TipoRespuesta");
        $query->execute();

        return $query->fetchAll();
    }

}

?>