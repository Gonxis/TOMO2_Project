<?php session_start();

include_once ('../../TOMO2-Web/includes/connection.php');
include_once ('../../TOMO2-Web/includes/New.php');
include_once ('../../TOMO2-Web/PDO/NewModel.php');
//include_once ('../img_bbdd/upload.php');

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {

    $id_news = $_GET['id_news'];

    $news = new News();
    $newModel = new NewModel();
    $image = array(null);
    $directory = "img_bbdd/helados.jpg";

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

        if (isset($_POST['guardar'])){

            if (isset($_FILES['image'])){

                $image['name'] = date('ymhis') . $_FILES['image']['name'];
                $image['directory'] = '../img_bbdd/';
                move_uploaded_file($_FILES['image']['tmp_name'], $image['directory'] . $image['name']);
                $directory = 'img_bbdd/' . $image['name'];
            } else {
                $image = 'img_bbdd/helados.jpg'; $directory = "img_bbdd/helados.jpg";
            }

        }

        switch ($_REQUEST['action']) {

            case 'update':

                /*echo "<script type=\"text/javascript\">
                alert('¡El registro se ha actualizado exitosamente! El directorio de la imagen es: $directory');
                //history.go(-2);
                </script>";*/

                $news->__SET('id_news'      , $_REQUEST['id_news']);
                $news->__SET('name'         , $_REQUEST['name']);
                $news->__SET('description'  , $_REQUEST['description']);
                $news->__SET('upload_date'  , $_REQUEST['upload_date']);
                $news->__SET('image'        , $directory);
                $news->__SET('link'         , $_REQUEST['link']);
                $news->__SET('active'       , $_REQUEST['active']);

                $newModel->Update($news);
                echo "<script type=\"text/javascript\">
                alert('¡El registro se ha actualizado exitosamente! El directorio de la imagen es: $directory');
                history.go(-2);
                </script>";
                break;

            case 'insert':

                //$news->__SET('id_news'      , $_REQUEST['id_news']);
                $news->__SET('name'         , $_REQUEST['name']);
                $news->__SET('description'  , $_REQUEST['description']);
                $news->__SET('upload_date'  , $_REQUEST['upload_date']);
                $news->__SET('image'        , $directory);
                $news->__SET('link'         , $_REQUEST['link']);
                $news->__SET('active'       , $_REQUEST['active']);

                $newModel->Insert($news);
                echo "<script type=\"text/javascript\">
                alert('Se ha añadido correctamente a la base de datos una nueva noticia');
                history.go(-2);
                </script>";
                break;

            case 'edit':

                $news = $newModel->Obtain($_REQUEST['id_news']);
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
        <title><?php if ($id_news > 0) { echo "Modificar"; } else { echo "Añadir";}?> Noticia</title>
        <link href="../../Card-2/card-2.css" type="text/css" rel="stylesheet">
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">-->
        <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>

    <body>
    <main class="col l1 m1 s1 center"> <!--id="container"-->
        <h3><?php if ($id_news > 0) { echo "Modificar"; } else { echo "Añadir";}?> Noticia</h3>
        <!--<div class="img-wrapper"> <img src="img/tomo2Inicio.jpg" alt="Just Background"> </div>-->
        <!--<div style="padding-left:38%; padding-top:10px; padding-bottom:10px;">-->

        <?php
        if (isset($error)) { ?>
            <small style="color:#aa0000;"><?php echo $error; ?></small>
            <br /><br />
            <?php
        }
        ?>

        <form action="?action=<?php echo $id_news > 0 ? 'update' : 'insert'; ?>" method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="id_news" value="<?php echo $news->__GET('id_news'); ?>"/>
            <input type="text" name="name" value="<?php echo $news->__GET('name'); ?>" placeholder="Nombre"/>
            <input type="text" name="description" value="<?php echo $news->__GET('description'); ?>" placeholder="Descripción"/>
            <input type="text" name="upload_date" value="<?php echo $news->__GET('upload_date'); ?>" placeholder="Dia de subida"/>
            <input type="file" name="image" /> <!--value="<?php //echo $news->__GET('image'); ?>"-->
            <input type="text" name="link" value="<?php echo $news->__GET('link'); ?>" placeholder="Link hacia el fichero"/>
            <input type="text" name="active" value="<?php echo $news->__GET('active'); ?>" placeholder="0 = falso; 1 = verdadero"/>
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