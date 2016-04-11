<?php session_start();

include_once ('../../TOMO2-Web/includes/connection.php');
include_once ('../../TOMO2-Web/includes/product.php');
include_once ('../../TOMO2-Web/includes/productModel.php');

$id_product = $_GET['id_product'];

$product = new Product();
$productModel = new productModel();

if (isset($_REQUEST['action'])) {

    switch ($_REQUEST['action']) {

        case 'edit':


            $product = $productModel->Obtain($_REQUEST['id_product']);

            ######  ES AQUI DONDE SE TIENE HACER LO DE UPDATE (EN LOS OTROS HAY OTRO CASE, EN ESTE NO PUEDE SER)  ######

            //echo '<script language="javascript">alert("¡Hemos entrado en edit de modifica producto!");</script>';getmdll.io



            #echo "<script type=\"text/javascript\">
            #    alert('¡El registro se ha actualizado exitosamente!');
            #    history.go(-1);
            #    </script>";
            break;
    }
}

echo "Aqui entro <br>";
echo 'ID: ' . $product -> $_POST('id_product') . '<br/>';
echo 'Nombre: ' . $product-> $_POST('name') . '<br>';
echo 'Descripcion: ' . $product->$_POST('description') . '<br>';
echo 'Categoria: ' . $product->$_POST('category') . '<br>';
echo 'Subcategoria: ' . $product->$_POST('subcategory') . '<br>';
echo 'Activo: ' . $product->$_POST('active') . '<br>';