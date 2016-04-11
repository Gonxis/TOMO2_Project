<?php

session_start();

include_once ('../includes/connection.php');
include_once ('../includes/Contest.php');

$contest = new Contest();

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {
    if (isset($_GET['id_event'])) {
        $id_news = $_GET['id_event'];

        $query = $pdo->prepare('DELETE FROM Concursos WHERE id_event = ?');
        $query->bindValue(1, $id_event);

        $query->execute();

        echo "<script type=\"text/javascript\">
           alert('Se ha borrado correctamente el concurso');
           history.go(-2);
       </script>";
        exit;
    }

    $contests = $contest->fetch_all();
    ?>

    <html>
    <head>
        <title>Eliminar Concurso - Version editable</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>

    <body>
    <div class="container">
        <!--<a href="index.php" id="logo">CMS</a>-->

        <br/>

        <h4>Selecciona un concurso para borrar</h4>

        <form action="deleteContest.php" method="get">
            <select onchange="this.form.submit();" name="id_event">
                <?php foreach ($contests as $contest) { ?>
                    <option value="<?php echo $contest['id_event']; ?>">
                        <?php echo $contest['name']; ?>
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