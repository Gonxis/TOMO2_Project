<?php

session_start();

include_once ('../includes/connection.php');
include_once ('../includes/New.php');
//include_once ('../PDO/NewModel.php');

$new = new News();

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {
    if (isset($_GET['id_news'])) {
        $id_news = $_GET['id_news'];

        //echo "<script type=\"text/javascript\">
        //   alert('Se ha borrado correctamente la noticia');
           //history.go(-2);
        //</script>";
        //exit;

        $query = $pdo->prepare('DELETE FROM Noticias WHERE id_news = ?');
        $query->bindValue(1, $id_news);

        $query->execute();

        echo "<script type=\"text/javascript\">
           alert('Se ha borrado correctamente la noticia');
           history.go(-2);
        </script>";
        exit;
    }

    $news = $new->fetch_all();
    ?>

    <html>
    <head>
        <title>Eliminar Noticia - Version editable</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>

    <body>
    <div class="container">
        <!--<a href="index.php" id="logo">CMS</a>-->

        <br/>

        <h4>Selecciona una noticia para borrar</h4>

        <form action="deleteNew.php" method="get" onsubmit="return confirmation()">
            <select onchange="this.form.submit();" name="id_news">
                <?php foreach ($news as $new) { ?>
                    <option value="<?php echo $new['id_news']; ?>">
                        <?php echo $new['name']; ?>
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

<script type="text/javascript">

    function confirmation() {
        if(confirm("¿Realmente desea eliminar?"))
        {
            return true;
        }
        return false;
    }

</script>
