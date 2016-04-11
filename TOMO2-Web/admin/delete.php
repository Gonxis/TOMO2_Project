<?php

session_start();

include_once ('../../TOMO2-Web/includes/connection.php');
include_once ('../../TOMO2-Web/includes/product.php');

$product = new Product();

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {
    if (isset($_GET['id_product'])) {
        $id_product = $_GET['id_product'];

        //echo "<script type=\"text/javascript\">
        //   alert('Se ha borrado correctamente el producto');
           //history.go(-2);
        //</script>";
        //exit;

        $query = $pdo->prepare('DELETE FROM Productos WHERE id_product = ?');
        $query->bindValue(1, $id_product);

        $query->execute();

        echo "<script type=\"text/javascript\">
           alert('Se ha borrado correctamente el producto');
           history.go(-2);
       </script>";
        exit;
    }

    $products = $product->fetch_all();
    ?>

    <html>
    <head>
        <title>Eliminar Producto - Version editable</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>

    <body>
    <div class="container">
        <!--<a href="index.php" id="logo">CMS</a>-->

        <br/>

        <h4>Selecciona un producto para borrar</h4>

        <form action="delete.php" method="get">
            <select onchange="this.form.submit();" name="id_product">
                <?php foreach ($products as $product) { ?>
                    <option value="<?php echo $product['id_product']; ?>">
                        <?php echo $product['name']; ?>
                    </option>
                <?php } ?>
            </select>
        </form>
    </div>
    </body>
    </html>

    <?php
} else {
    echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
    exit;
}
?>