<?php

session_start();

include_once ('../includes/connection.php');
include_once ('../includes/product.php');

$product = new News;

if (isset($_SESSION['logged_in'])) {
    if (isset($_GET['id_product'])){
        $id_product = $_GET['id_product'];

        $query = $pdo->prepare('DELETE FROM Productos WHERE id_product = ?');
        $query = bindValue(1, $id_product);

        $query->execute();

        header('Location: delete.php');
    }

    $products = $product->fetch_all();
    ?>

    <html>
        <head>
            <title>index - editable Version</title>
        </head>

        <body>
            <div class="container">
                <a href="index.php" id="logo">CMS</a>

                <br />

                <h4>Select a product to Delete</h4>

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
    header('Location: index.php');
    exit();
}

?>