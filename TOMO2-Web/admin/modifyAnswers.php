<?php session_start();

include_once ('../../TOMO2-Web/includes/connection.php');
include_once ('../../TOMO2-Web/includes/Answer.php');
include_once ('../../TOMO2-Web/PDO/AnswerModel.php');
include_once ('../../TOMO2-Web/includes/Contest.php');
include_once ('../../TOMO2-Web/PDO/ContestModel.php');
//include_once ('../img_bbdd/upload.php');

$conc = new Contest();

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {

    $id_answer = $_GET['id_answer'];
    $id_event = $_GET['id_event'];

    $concursos = $conc->fetch_all();


    $answer = new Answer();
    $answerModel = new AnswerModel();
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

                $answer->__SET('id_answer'      , $_REQUEST['id_answer']);
                $answer->__SET('id_event'       , $_REQUEST['id_event']);
                $answer->__SET('respuesta'      , $_REQUEST['respuesta']);
                $answer->__SET('correct'        , $_REQUEST['correct']);

                $answerModel->Update($answer);
                echo "<script type=\"text/javascript\">
                alert('¡El registro se ha actualizado exitosamente! El directorio de la imagen es: $directory');
                history.go(-2);
                </script>";
                break;

            case 'insert':

                //$answer->__SET('id_answer'      , $_REQUEST['id_answer']);
                $answer->__SET('id_event'         , $_REQUEST['id_event']);
                $answer->__SET('respuesta'        , $_REQUEST['respuesta']);
                $answer->__SET('correct'          , $_REQUEST['correct']);

                $answerModel->Insert($answer);
                echo "<script type=\"text/javascript\">
                alert('Se ha añadido correctamente a la base de datos una respuesta');
                history.go(-2);
                </script>";
                break;

            case 'edit':

                $answer = $answerModel->Obtain($_REQUEST['id_answer']);
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
        <title><?php if ($id_answer > 0) { echo "Modificar"; } else { echo "Añadir";}?> Respuesta</title>
        <link href="../../Card-2/card-2.css" type="text/css" rel="stylesheet">
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">-->
        <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>

    <body>
    <main class="col l1 m1 s1 center"> <!--id="container"-->
        <h3><?php if ($id_answer > 0) { echo "Modificar"; } else { echo "Añadir";}?> Respuesta</h3>
        <!--<div class="img-wrapper"> <img src="img/tomo2Inicio.jpg" alt="Just Background"> </div>-->
        <!--<div style="padding-left:38%; padding-top:10px; padding-bottom:10px;">-->

        <?php
        if (isset($error)) { ?>
            <small style="color:#aa0000;"><?php echo $error; ?></small>
            <br /><br />
            <?php
        }
        ?>

        <form action="?action=<?php echo $id_answer > 0 ? 'update' : 'insert'; ?>" method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="id_answer" value="<?php echo $answer->__GET('id_answer'); ?>"/>
<!--            <input type="text" name="id_event" value="--><?php //echo $answer->__GET('id_event'); ?><!--" placeholder="Id_event"/>-->
            <select class="browser-default" name="id_event">
                <option value="" disabled selected>¿A qué pregunta está asociada esta respuesta?</option>
                <?php foreach ($concursos as $conc) { ?>
                    <option value="<?php echo $conc['id_event']; ?>">
                        <?php echo $conc['question']; ?>
                    </option>
                <?php } ?>
            </select>
            <input type="text" name="respuesta" value="<?php echo $answer->__GET('respuesta'); ?>" placeholder="Respuesta"/>
            <input type="text" name="correct" value="<?php echo $answer->__GET('correct'); ?>" placeholder="0 = falso; 1 = verdadero"/>
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