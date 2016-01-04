<?php

class NewModel{
    private $pdo;

    public function __CONSTRUCT(){

        try{

            $this->pdo = new PDO('mysql:host=localhost;dbname=TOMO2', 'root', 'root');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (Exception $e){

            die ($e->getMessage());

        }
    }

    public function ListAll(){

        try {

            $result = array();

            $query = $this->pdo->prepare('SELECT * FROM Noticias');
            $query->execute();

            foreach ($query->fetchAll(PDO::FETCH_OBJ) as $r){

                $news = new News();

                $news->__SET('id_news', $r->id_news);
                $news->__SET('name', $r->name);
                $news->__SET('description', $r->description);
                $news->__SET('upload_date', $r->upload_date);
                $news->__SET('image', $r->image);
                $news->__SET('link', $r->link);
                $news->__SET('active', $r->active);

                $result[] = $news;

            }

            return $result;

        } catch (Exception $e){

            die ($e->getMessage());

        }
    }

    public function Obtain($id_news){

        try {

            $query = $this->pdo->prepare('SELECT * FROM Noticias WHERE id_news = ?');

            $query->execute(array($id_news));
            $r = $query->fetch(PDO::FETCH_OBJ);

            $news = new News();

            $news->__SET('id_news', $r->id_news);
            $news->__SET('name', $r->name);
            $news->__SET('description', $r->description);
            $news->__SET('upload_date', $r->upload_date);
            $news->__SET('image', $r->image);
            $news->__SET('link', $r->link);
            $news->__SET('active', $r->active);

            return $news;

        } catch (Exception $e){

            die ($e->getMessage());

        }

    }

    public function Delete($id_news){

        try {

            $query = $this->pdo->prepare('DELETE FROM Noticias WHERE id_news = ?');

            $query->execute(array($id_news));

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function Update(News $data){

        try {

            $query = "UPDATE Noticias SET
                            name        = ?,
                            description = ?,
                            upload_date    = ?,
                            active      = ?
                            link       = ?,
                      WHERE id_news  = ?";

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

    public function Insert(News $data){

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

class News {

    private $id_news;
    private $name;
    private $description;
    private $upload_date;
    private $image;
    private $link;
    private $active;

    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }

}

$news = new News();
$newModel = new NewModel();

if (isset($_REQUEST['action'])){

    switch ($_REQUEST['action']){

        case 'update':

            $news->__SET('id_news',       $_REQUEST['id_news']);
            $news->__SET('name',          $_REQUEST['name']);
            $news->__SET('description',   $_REQUEST['description']);
            $news->__SET('upload_date',   $_REQUEST['upload_date']);
            $news->__SET('image',         $_REQUEST['image']);
            $news->__SET('link',          $_REQUEST['link']);
            $news->__SET('active',        $_REQUEST['active']);

            $newModel->Update ($news);
            header ('Location:index.php');
            break;

        case 'insert':

            $news->__SET('id_news',       $_REQUEST['id_news']);
            $news->__SET('name',          $_REQUEST['name']);
            $news->__SET('description',   $_REQUEST['description']);
            $news->__SET('upload_date',   $_REQUEST['upload_date']);
            $news->__SET('image',         $_REQUEST['image']);
            $news->__SET('link',          $_REQUEST['link']);
            $news->__SET('active',        $_REQUEST['active']);

            $newModel->Insert ($news);
            header ('Location:index.php');
            break;

        case 'delete':

            $newModel->Delete ($_REQUEST['id_news']);
            header ('Location: index.php');
            break;

        case 'edit':

            $news = $newModel->Obtain($_REQUEST['id_news']);
            break;

        default:

            echo "Error with the request action";
            break;

    }
}

?>

<form action="?action=<?php echo $news->id_news > 0 ? 'update' : 'insert'; ?>" method="post">
    <input type="hidden" name="id_news" value="<?php echo $news->__GET('id_news'); ?>" />
    <table style="width: 500px; background: #eee; padding: 4px;">
        <tr>
            <th style="text-align: left;">Name</th>
            <td><input type="text" name="name" value="<?php echo $news->__GET('name'); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th style="text-align: left;">Description</th>
            <td><input type="text" name="description" value="<?php echo $news->__GET('description'); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th style="text-align: left;">Upload Date</th>
            <td><input type="text" name="upload_date" value="<?php echo $news->__GET('upload_date'); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th style="text-align: left;">Image</th>
            <td><input type="text" name="image" value="<?php echo $news->__GET('image'); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th style="text-align: left;">Link</th>
            <td><input type="text" name="link" value="<?php echo $news->__GET('link'); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th style="text-align: left;">Active</th>
            <td><input type="text" name="active" value="<?php echo $news->__GET('active'); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit">Save</button>
            </td>
        </tr>
    </table>
</form>
<br />

<table style="width: 500px; background: #eee; padding: 4px;">
    <tr>
        <th style="text-align: left;">Name</th>
        <th style="text-align: left;">Description</th>
        <th style="text-align: left;">Upload Date</th>
        <th style="text-align: left;">Image</th>
        <th style="text-align: left;">Link</th>
        <th style="text-align: left;">Active</th>
        <th></th>
    </tr>
    <?php foreach ($newModel->ListAll() as $r): ?>
        <tr>
            <td><?php echo $r->__GET('name'); ?></td>
            <td><?php echo $r->__GET('description'); ?></td>
            <td><?php echo $r->__GET('upload_date'); ?></td>
            <td><?php echo $r->__GET('image'); ?></td>
            <td><?php echo $r->__GET('link'); ?></td>
            <td><?php echo $r->__GET('active'); ?></td>
            <td>
                <a href="?action=edit&id_news=<?php echo $r->id_news; ?>">E</a>
                <a href="?action=delete&id_news=<?php echo $r->id_news; ?>">X</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>