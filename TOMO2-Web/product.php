<?php

include_once ('includes/connection.php');
include_once ('includes/product.php');

$product = new News;

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $data = $product->fetch_data($id);
} else {
    header('Location: index.php');
    exit();
}

?>