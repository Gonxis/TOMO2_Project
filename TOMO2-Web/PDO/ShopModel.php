<?php

class ShopModel{
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

            $query = $this->pdo->prepare('SELECT * FROM Tiendas');
            $query->execute();

            foreach ($query->fetchAll(PDO::FETCH_OBJ) as $r){

                $shop = new News();

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

        } catch (Exception $e){

            die ($e->getMessage());

        }
    }

    public function Obtain($id_shop){

        try {

            $query = $this->pdo->prepare('SELECT * FROM Tiendas WHERE id_shop = ?');

            $query->execute(array($id_shop));
            $r = $query->fetch(PDO::FETCH_OBJ);

            $shop = new News();

            $shop->__SET('id_shop', $r->id_shop);
            $shop->__SET('name', $r->name);
            $shop->__SET('description', $r->description);
            $shop->__SET('tel_number', $r->tel_number);
            $shop->__SET('iframe', $r->iframe);
            $shop->__SET('image', $r->image);
            $shop->__SET('active', $r->active);

            return $shop;

        } catch (Exception $e){

            die ($e->getMessage());

        }

    }

    public function Delete($id_shop){

        try {

            $query = $this->pdo->prepare('DELETE FROM Tiendas WHERE id_shop = ?');

            $query->execute(array($id_shop));

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function Update(News $data){

        try {

            $query = "UPDATE Tiendas SET
                            name        = ?,
                            description = ?,
                            tel_number    = ?,
                            iframe       = ?,
                            active      = ?
                      WHERE id_shop  = ?";

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

    public function Insert(News $data){

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

class Shop {

    private $id_shop;
    private $name;
    private $description;
    private $tel_number;
    private $iframe;
    private $image;
    private $active;

    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }

}

$shop = new News();
$shopModel = new NewModel();

if (isset($_REQUEST['action'])){

    switch ($_REQUEST['action']){

        case 'update':

            $shop->__SET('id_shop',       $_REQUEST['id_shop']);
            $shop->__SET('name',          $_REQUEST['name']);
            $shop->__SET('description',   $_REQUEST['description']);
            $shop->__SET('tel_number',    $_REQUEST['tel_number']);
            $shop->__SET('iframe',        $_REQUEST['iframe']);
            $shop->__SET('image',         $_REQUEST['image']);
            $shop->__SET('active',        $_REQUEST['active']);

            $shopModel->Update ($shop);
            header ('Location:index.php');
            break;

        case 'insert':

            $shop->__SET('id_shop',       $_REQUEST['id_shop']);
            $shop->__SET('name',          $_REQUEST['name']);
            $shop->__SET('description',   $_REQUEST['description']);
            $shop->__SET('tel_number',    $_REQUEST['tel_number']);
            $shop->__SET('iframe',        $_REQUEST['iframe']);
            $shop->__SET('image',         $_REQUEST['image']);
            $shop->__SET('active',        $_REQUEST['active']);

            $shopModel->Insert ($shop);
            header ('Location:index.php');
            break;

        case 'delete':

            $shopModel->Delete ($_REQUEST['id_shop']);
            header ('Location: index.php');
            break;

        case 'edit':

            $shop = $shopModel->Obtain($_REQUEST['id_shop']);
            break;

        default:

            echo "Error with the request action";
            break;

    }
}

?>

    <form action="?action=<?php echo $shop->id_shop > 0 ? 'update' : 'insert'; ?>" method="post">
        <input type="hidden" name="id_shop" value="<?php echo $shop->__GET('id_shop'); ?>" />
        <table style="width: 500px; background: #eee; padding: 4px;">
            <tr>
                <th style="text-align: left;">Name</th>
                <td><input type="text" name="name" value="<?php echo $shop->__GET('name'); ?>" style="width: 100%;" /></td>
            </tr>
            <tr>
                <th style="text-align: left;">Description</th>
                <td><input type="text" name="description" value="<?php echo $shop->__GET('description'); ?>" style="width: 100%;" /></td>
            </tr>
            <tr>
                <th style="text-align: left;">Tel. Number</th>
                <td><input type="text" name="tel_number" value="<?php echo $shop->__GET('tel_number'); ?>" style="width: 100%;" /></td>
            </tr>
            <tr>
                <th style="text-align: left;">Iframe</th>
                <td><input type="text" name="iframe" value="<?php echo $shop->__GET('iframe'); ?>" style="width: 100%;" /></td>
            </tr>
            <tr>
                <th style="text-align: left;">Image</th>
                <td><input type="text" name="image" value="<?php echo $shop->__GET('image'); ?>" style="width: 100%;" /></td>
            </tr>
            <tr>
                <th style="text-align: left;">Active</th>
                <td><input type="text" name="active" value="<?php echo $shop->__GET('active'); ?>" style="width: 100%;" /></td>
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
        <th style="text-align: left;">Tel. Number</th>
        <th style="text-align: left;">Iframe</th>
        <th style="text-align: left;">Image</th>
        <th style="text-align: left;">Active</th>
        <th></th>
    </tr>
<?php foreach ($shopModel->ListAll() as $r): ?>
    <tr>
        <td><?php echo $r->__GET('name'); ?></td>
        <td><?php echo $r->__GET('description'); ?></td>
        <td><?php echo $r->__GET('tel_number'); ?></td>
        <td><?php echo $r->__GET('iframe'); ?></td>
        <td><?php echo $r->__GET('image'); ?></td>
        <td><?php echo $r->__GET('active'); ?></td>
        <td>
            <a href="?action=edit&id_shop=<?php echo $r->id_shop; ?>">E</a>
            <a href="?action=delete&id_shop=<?php echo $r->id_shop; ?>">X</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>