<?php

session_start();

include_once ('../includes/connection.php');
include_once ('../includes/tipoRespuesta.php');
include_once ('../includes/Answer.php');
//include_once ('../PDO/NewModel.php');

$tipo = new TipoRespuesta();
$respuesta = new Answer();

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {
    if (isset($_GET['id_type'])) {
        $id_type = $_GET['id_type'];
        $id_answer = $_GET['id_answer'];

        //echo "<script type=\"text/javascript\">
        //   alert('Se ha borrado correctamente la noticia');
        //history.go(-2);
        //</script>";
        //exit;

        $query = $pdo->prepare('DELETE FROM TipoRespuesta WHERE id_type = ?');
        $query = bindValue(1, $id_type);

        $query->execute();

        echo "<script type=\"text/javascript\">
           alert('Se ha borrado correctamente el tipo');
           history.go(-2);
        </script>";
        exit;
    }

    $tipos = $tipo->fetch_all();
    $respuestas = $respuesta->fetch_all();
    ?>

    <html xmlns="http://www.w3.org/1999/html">
    <head>
        <title>Eliminar Tipo - Version editable</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="../../Card-2/card-2.css" type="text/css" rel="stylesheet">
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">-->
        <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>

    <body>
    <div class="container">
        <!--<a href="index.php" id="logo">CMS</a>-->

        <br/>

        <h4>Selecciona un tipo para borrar</h4>


<!--        <form>-->
<!--            --><?php //foreach ($tipos as $tipo) { ?>
<!--                <p>-->
<!--                    <input type="checkbox" value="--><?php //echo $tipo['tipo']; ?><!--" id="tipo" name="tipo" >-->
<!--                    <label for="tipo">--><?php //echo $tipo['tipo']; ?><!--</label>-->
<!--                </p>-->
<!--            --><?php //} ?>
<!--        </form>-->

        <form>
            <?php $counter = 1; ?>
            <?php foreach ($respuestas as $respuesta) { ?>
                <p>
                    <input type="checkbox" value="<?php echo $respuesta['respuesta']; ?>" id="<?php echo $counter; ?>" name="answers" />
                    <label for="<?php echo $counter; ?>"><?php echo $respuesta['respuesta']; ?></label>
                </p>

            <?php $counter++; } ?>
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

<script type="text/javascript">

    function confirmation() {
        if(confirm("¿Realmente desea eliminar?"))
        {
            return true;
        }
        return false;
    }

</script>

