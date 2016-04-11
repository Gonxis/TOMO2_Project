<?php

session_start();

include_once ('../includes/connection.php');


if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {
if (isset($_GET['id_type'], $_GET['name'], $_GET['question'], $_GET['initial_date'], $_GET['final_date'], $_GET['active'])){
    $id_type = $_GET['id_type'];
    $name = $_GET['name'];
    $question = nl2br($_GET['question']);
    $initial_date = $_GET['initial_date'];
    $final_date = $_GET['final_date'];
    $active = $_GET['active'];

    if (empty($name) or empty($question) or empty($initial_date) or empty($final_date)){
        $error = 'Hay algunos campos vacíos por rellenar.';
    } else {
        $query = $pdo->prepare('INSERT INTO Concursos (id_type, name, question, initial_date, final_date, active) VALUES (?, ?, ?, ?, ?, ?)');

        $query->bindValue (1, $id_type);
        $query->bindValue (2, $name);
        $query->bindValue (3, $question);
        $query->bindValue (4, $initial_date);
        $query->bindValue (5, $final_date);
        $query->bindValue (6, $active);

        $query->execute();

        echo "<script type=\"text/javascript\">
            alert('Se ha añadido correctamente a la base de datos un nuevo concurso');
            history.go(-2);
            </script>";
        exit;
    }
}
?>

<html>
<head>
    <title>Añadir Concurso - Version editable</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>

<body>
<div class="container">
    <!--<a href="index.php" id="logo">CMS</a>-->

    <br />

    <h4>Añadir Concurso</h4>

    <?php
    if (isset($error)) { ?>
        <small style="color:#aa0000;"><?php echo $error; ?></small>
        <br /><br />
        <?php
    }
    ?>

    <form action="addContest.php" method="get" autocomplete="off">
        <input type="text" name="name" placeholder="Nombre">
        <input type="text" name="question" placeholder="Pregunta">
        <input type="text" name="type" placeholder="Tipo de respuesta">
        <input type="text" name="initial_date" placeholder="Día inicial">
        <input type="text" name="final_date" placeholder="Día final">
        <input type="number" name="active" placeholder="0 = falso; 1 = verdad">
        <input type="submit" value="Añadir Concurso">
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