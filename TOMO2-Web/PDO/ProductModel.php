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

            $query = $this->pdo->prepare('SELECT * FROM Productos');
            $query->execute();

            foreach ($query->fetchAll(PDO::FETCH_OBJ) as $r){

                $prdt = new News();

                $prdt->__SET('id_product', $r->id_product);
                $prdt->__SET('name', $r->name);
                $prdt->__SET('description', $r->description);
                $prdt->__SET('category', $r->category);
                $prdt->__SET('subcategory', $r->subcategory);
                $prdt->__SET('image', $r->image);
                $prdt->__SET('active', $r->active);

                $result[] = $prdt;

            }

            return $result;

        } catch (Exception $e){

            die ($e->getMessage());

        }
    }

    public function Obtain($id_product){

        try {

            $query = $this->pdo->prepare('SELECT * FROM Productos WHERE id_product = ?');

            $query->execute(array($id_product));
            $r = $query->fetch(PDO::FETCH_OBJ);

            $prdt = new News();

            $prdt->__SET('id_product', $r->id_product);
            $prdt->__SET('name', $r->name);
            $prdt->__SET('description', $r->description);
            $prdt->__SET('category', $r->category);
            $prdt->__SET('subcategory', $r->subcategory);
            $prdt->__SET('image', $r->image);
            $prdt->__SET('active', $r->active);

            return $prdt;

        } catch (Exception $e){

            die ($e->getMessage());

        }

    }

    public function Delete($id_product){

        try {

            $query = $this->pdo->prepare('DELETE FROM Productos WHERE id_product = ?');

            $query->execute(array($id_product));

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function Update(News $data){

        try {

            $query = "UPDATE Productos SET
                            name        = ?,
                            description = ?,
                            category    = ?,
                            image       = ?,
                            active      = ?
                      WHERE id_product  = ?";

            $this->pdo->prepare($query)->execute(
                                            array(
                                                $data->__GET('name'),
                                                $data->__GET('description'),
                                                $data->__GET('category'),
                                                $data->__GET('subcategory'),
                                                $data->__GET('image'),
                                                $data->__GET('active'),
                                                $data->__GET('id_product')
                                            )
                                        );

        } catch (Exception $e) {

            die ($e->getMessage());

        }
    }

    public function Insert(News $data){

        try {

            $query = "INSERT INTO Productos (name, description, category, subcategory, image, active)
                      VALUES (?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($query)->execute(
                                            array(
                                                $data->__GET('name'),
                                                $data->__GET('description'),
                                                $data->__GET('category'),
                                                $data->__GET('subcategory'),
                                                $data->__GET('image'),
                                                $data->__GET('active')
                                            )
                                         );

        } catch (Exception $e) {

            die ($e->getMessage());

        }

    }

}

class Product {

    private $id_product;
    private $name;
    private $description;
    private $category;
    private $subcategory;
    private $image;
    private $active;

    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }

}

$prdt = new News();
$productModel = new NewModel();

if (isset($_REQUEST['action'])){

    switch ($_REQUEST['action']){

        case 'update':

            $prdt->__SET('id_product',    $_REQUEST['id_product']);
            $prdt->__SET('name',          $_REQUEST['name']);
            $prdt->__SET('description',   $_REQUEST['description']);
            $prdt->__SET('category',      $_REQUEST['category']);
            $prdt->__SET('subcategory',   $_REQUEST['subcategory']);
            $prdt->__SET('image',         $_REQUEST['image']);
            $prdt->__SET('active',        $_REQUEST['active']);

            $productModel->Update ($prdt);
            header ('Location:index.php');
            break;

        case 'insert':

            $prdt->__SET('name',          $_REQUEST['name']);
            $prdt->__SET('description',   $_REQUEST['description']);
            $prdt->__SET('category',      $_REQUEST['category']);
            $prdt->__SET('subcategory',   $_REQUEST['subcategory']);
            $prdt->__SET('image',         $_REQUEST['image']);
            $prdt->__SET('active',        $_REQUEST['active']);

            $productModel->Insert ($prdt);
            header ('Location:index.php');
            break;

        case 'delete':

            $productModel->Delete ($_REQUEST['id_product']);
            header ('Location: index.php');
            break;

        case 'edit':

            $prdt = $productModel->Obtain($_REQUEST['id_product']);
            break;

        default:

            echo "Error with the request action";
            break;

    }
}

?>

<form action="?action=<?php echo $prdt->id_shop > -1 ? 'update' : 'insert'; ?>" method="post">
    <input type="hidden" name="id_product" value="<?php echo $prdt->__GET('id_product'); ?>" />
    <table style="width: 500px; background: #eee; padding: 4px;">
        <tr>
            <th style="text-align: left;">Name</th>
            <td><input type="text" name="name" value="<?php echo $prdt->__GET('name'); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th style="text-align: left;">Description</th>
            <td><input type="text" name="description" value="<?php echo $prdt->__GET('description'); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th style="text-align: left;">Category</th>
            <td><input type="text" name="category" value="<?php echo $prdt->__GET('category'); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th style="text-align: left;">Subcategory</th>
            <td><input type="text" name="subcategory" value="<?php echo $prdt->__GET('subcategory'); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th style="text-align: left;">Image</th>
            <td><input type="text" name="image" value="<?php echo $prdt->__GET('image'); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th style="text-align: left;">Active</th>
            <td><input type="text" name="active" value="<?php echo $prdt->__GET('active'); ?>" style="width: 100%;" /></td>
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
        <th style="text-align: left;">Category</th>
        <th style="text-align: left;">Subcategory</th>
        <th style="text-align: left;">Image</th>
        <th style="text-align: left;">Active</th>
        <th></th>
    </tr>
    <?php foreach ($productModel->ListAll() as $r): ?>
        <tr>
            <td><?php echo $r->__GET('name'); ?></td>
            <td><?php echo $r->__GET('description'); ?></td>
            <td><?php echo $r->__GET('category'); ?></td>
            <td><?php echo $r->__GET('subcategory'); ?></td>
            <td><?php echo $r->__GET('image'); ?></td>
            <td><?php echo $r->__GET('active'); ?></td>
            <td>
                <a href="?action=edit&id_product=<?php echo $r->id_product; ?>">E</a>
                <a href="?action=delete&id_product=<?php echo $r->id_product; ?>">X</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>