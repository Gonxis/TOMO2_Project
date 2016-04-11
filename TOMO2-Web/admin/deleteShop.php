<?php

session_start();

include_once ('../includes/connection.php');
include_once ('../includes/Shop.php');

$shop = new Shop();

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {
if (isset($_GET['id_shop'])){
    $id_shop = $_GET['id_shop'];

    $query = $pdo->prepare('DELETE FROM Tiendas WHERE id_shop = ?');

    $query->bindValue(1, $id_shop);
    $query->execute();

    echo "<script type=\"text/javascript\">
           alert('Se ha borrado correctamente la tienda');
           history.go(-2);
       </script>";
    exit;
}

$shops = $shop->fetch_all();
?>

<html>
<head>
    <title>Eliminar Tienda - Version editable</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>

<body>
<div class="container">
    <!--<a href="index.php" id="logo">CMS</a>-->

    <br />

    <h4>Selecciona una tienda para borrar</h4>

    <form action="deleteShop.php" method="get">
        <select onchange="this.form.submit();" name="id_shop">
            <?php foreach ($shops as $shop) { ?>
                <option value="<?php echo $shop['id_shop']; ?>">
                    <?php echo $shop['name']; ?>
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