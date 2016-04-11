<?php session_start();

include_once ('../../TOMO2-Web/includes/connection.php');
include_once ('../../TOMO2-Web/includes/Shop.php');
include_once ('../../TOMO2-Web/PDO/ShopModel.php');

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {

    $id_shop = $_GET['id_shop'];

    $shop = new Shop();
    $shopModel = new ShopModel();

    /*
    if (isset($_GET['name'], $_GET['description'], $_GET['upload_date'], $_GET['image'], $_GET['link'], $_GET['active'])){
        $name = $_GET['name'];
        $description = nl2br($_GET['description']);
        $upload_date = $_GET['upload_date'];
        $link = $_GET['image'];
        $image = $_GET['link'];
        $active = $_GET['active'];

        if (empty($name) or empty($description) or empty($upload_date)){
            $error = 'There are some fields empty. The only empty field accepted is "image" or "link" field';
        } else {
            $query = $pdo->prepare('INSERT INTO Noticias (name, description, upload_date, image, link, active) VALUES (?, ?, ?, ?, ?, ?)');

            $query->bindValue (1, $name);
            $query->bindValue (2, $description);
            $query->bindValue (3, $upload_date);
            $query->bindValue (4, $image);
            $query->bindValue (5, $link);
            $query->bindValue (6, $active);

            $query->execute();

            echo "<script type=\"text/javascript\">
            alert('Se ha añadido correctamente a la base de datos una nueva noticia');
            history.go(-2);
            </script>";
            exit;
        }
    }*/
    if (isset($_REQUEST['action'])) {

        //echo "<script type=\"text/javascript\">
        //        alert('Comprobando valores...');
        //        </script>";

        switch ($_REQUEST['action']) {

            case 'update':


                //$shop->__SET('id_shop'      , $_REQUEST['id_shop']);
                $shop->__SET('name'         , $_REQUEST['name']);
                $shop->__SET('description'  , $_REQUEST['description']);
                $shop->__SET('tel_number'   , $_REQUEST['tel_number']);
                $shop->__SET('iframe'       , $_REQUEST['iframe']);
                $shop->__SET('image'        , $_REQUEST['image']);
                $shop->__SET('active'       , $_REQUEST['active']);

                $shopModel->Update($shop);
                echo "<script type=\"text/javascript\">
                alert('¡El registro se ha actualizado exitosamente!');
                history.go(-2);
                </script>";
                break;

            case 'insert':

                //$shop->__SET('id_shop'      , $_REQUEST['id_shop']);
                $shop->__SET('name'         , $_REQUEST['name']);
                $shop->__SET('description'  , $_REQUEST['description']);
                $shop->__SET('tel_number'   , $_REQUEST['tel_number']);
                $shop->__SET('iframe'       , $_REQUEST['iframe']);
                $shop->__SET('image'        , $_REQUEST['image']);
                $shop->__SET('active'       , $_REQUEST['active']);

                $shopModel->Insert($shop);
                echo "<script type=\"text/javascript\">
                alert('Se ha añadido correctamente a la base de datos una nueva Tienda');
                history.go(-2);
                </script>";
                break;

            case 'edit':

                $shop = $shopModel->Obtain($_REQUEST['id_shop']);
                break;

            default :
                $error = "Error with the request action";
                break;

        }
    }

    ?>

    <!doctype html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title><?php if ($id_shop > 0) { echo "Modificar"; } else { echo "Añadir";}?> Tienda</title>
        <link href="../../Card-2/card-2.css" type="text/css" rel="stylesheet">
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">-->
        <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>

    <body>
    <main class="col l1 m1 s1 center"> <!--id="container"-->
        <h3><?php if ($id_shop > 0) { echo "Modificar"; } else { echo "Añadir";}?> Tienda</h3>
        <!--<div class="img-wrapper"> <img src="img/tomo2Inicio.jpg" alt="Just Background"> </div>-->
        <!--<div style="padding-left:38%; padding-top:10px; padding-bottom:10px;">-->

        <?php
        if (isset($error)) { ?>
            <small style="color:#aa0000;"><?php echo $error; ?></small>
            <br /><br />
            <?php
        }
        ?>

        <form action="?action=<?php echo $id_shop > 0 ? 'update' : 'insert'; ?>" method="post" autocomplete="off">
            <input type="hidden" name="id_shop" value="<?php echo $shop->__GET('id_shop'); ?>"/>
            <input type="text" name="name" value="<?php echo $shop->__GET('name'); ?>" placeholder="Nombre"/>
            <input type="text" name="description" value="<?php echo $shop->__GET('description'); ?>" placeholder="Descripción"/>
            <input type="text" name="tel_number" value="<?php echo $shop->__GET('tel_number'); ?>" placeholder="Número de teléfono"/>
            <input type="text" name="iframe" value="<?php echo $shop->__GET('iframe'); ?>" placeholder="Link de Google Maps"/>
            <input type="file" name="image" value="<?php echo $shop->__GET('image'); ?>" placeholder="directorio de imagen"/>
            <input type="text" name="active" value="<?php echo $shop->__GET('active'); ?>" placeholder="0 = falso; 1 = verdadero"/>
            <input type="submit" name="guardar" value="guardar">
            <!--<button type="submit">guardar</button>-->
        </form>

    </main>
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