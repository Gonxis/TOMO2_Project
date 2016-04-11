<?php

session_start();

include_once ('../includes/connection.php');
include_once ('../includes/product.php');
include_once ('../includes/productModel.php');

    $prdt = new Product();
    $productModel = new ProductModel();

    if (isset($_REQUEST['action'])) {

        echo '<script language="javascript">alert("Hemos entrado en el 1er if! Encima, el nombre es: '. $_REQUEST['name'] .'");
        </script>';

        switch ($_REQUEST['action']) {

            case 'update':

                $prdt->__SET('id_product'   , $_REQUEST['id_product']);
                $prdt->__SET('name'         , $_REQUEST['name']);
                $prdt->__SET('description'  , $_REQUEST['description']);
                $prdt->__SET('category'     , $_REQUEST['category']);
                $prdt->__SET('subcategory'  , $_REQUEST['subcategory']);
                $prdt->__SET('image'        , $_REQUEST['image']);
                $prdt->__SET('active'       , $_REQUEST['active']);

                $productModel->Update($prdt);

                echo '<script language="javascript">alert("¡El registro se ha actualizado exitosamente!");</script>';

                header('Location: ../admin/index.php');
                break;

            case 'insert':

                $prdt->__SET('id_product'   , $_REQUEST['id_product']);
                $prdt->__SET('name'         , $_REQUEST['name']);
                $prdt->__SET('description'  , $_REQUEST['description']);
                $prdt->__SET('category'     , $_REQUEST['category']);
                $prdt->__SET('subcategory'  , $_REQUEST['subcategory']);
                $prdt->__SET('image'        , $_REQUEST['image']);
                $prdt->__SET('active'       , $_REQUEST['active']);

                $productModel->Insert($prdt);

                echo '<script language="javascript">alert("¡Se ha insertado el registro con éxito!");</script>';

                header('Location: ../admin/index.php');
                break;

            case 'delete':

                $productModel->Delete($_REQUEST['id_product']);

                echo '<script language="javascript">alert("Se ha borrado el registro con éxito!");</script>';

                header('Location: ../admin/index.php');
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
    <button style="float: right"><a href="../admin/index.php">Back</a></button>
    <form action="?action=<?php echo $prdt->id_product > 0 ? 'update' : 'insert'; ?>" method="post">
        <input type="hidden" name="id_product" value="<?php echo $prdt->__GET('id_product'); ?>"/>
        <table style="width: 500px; background: #eee; padding: 4px;">
            <tr>
                <th style="text-align: left;">Name</th>
                <td><input type="text" name="name" value="<?php echo $prdt->__GET('name'); ?>" style="width: 100%;"/>
                </td>
            </tr>
            <tr>
                <th style="text-align: left;">Description</th>
                <td><input type="text" name="description" value="<?php echo $prdt->__GET('description'); ?>"
                           style="width: 100%;"/></td>
            </tr>
            <tr>
                <th style="text-align: left;">Category</th>
                <td><input type="text" name="category" value="<?php echo $prdt->__GET('category'); ?>"
                           style="width: 100%;"/></td>
            </tr>
            <tr>
                <th style="text-align: left;">Subcategory</th>
                <td><input type="text" name="subcategory" value="<?php echo $prdt->__GET('subcategory'); ?>"
                           style="width: 100%;"/></td>
            </tr>
            <tr>
                <th style="text-align: left;">Image</th>
                <td><input type="text" name="image" value="<?php echo $prdt->__GET('image'); ?>" style="width: 100%;"/>
                </td>
            </tr>
            <tr>
                <th style="text-align: left;">Active</th>
                <td><input type="text" name="active" value="<?php echo $prdt->__GET('active'); ?>"
                           style="width: 100%;"/></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Save</button>
                </td>
            </tr>
        </table>
    </form>
    <br/>

    <table style="width: 1500px; background: #eee; padding: 15px;">
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
