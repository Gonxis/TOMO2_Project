<?php

class News
{

    private $id_news;
    private $name;
    private $description;
    private $upload_date;
    private $image;
    private $link;
    private $active;

    /*public function __CONSTRUCT($id_news, $name, $description, $upload_date, $image, $link, $active)
    {
        $this->id_news = $id_news;
        $this->name = $name;
        $this->description = $description;
        $this->upload_date = $upload_date;
        $this->image = $image;
        $this->link = $link;
        $this->active = $active;
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

        $query = $pdo->prepare ("SELECT * FROM Noticias");
        $query->execute();

        return $query->fetchAll();
    }

}

?>