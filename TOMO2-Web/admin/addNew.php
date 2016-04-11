<?php

session_start();

include_once ('../includes/connection.php');

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {
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
}
?>

<html>
<head>
    <title>Añadir Noticia - versión editable</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>

<body>
<div class="container">
    <!--<a href="index.php" id="logo">CMS</a>-->

    <br />

    <h4>Añadir Noticia</h4>

    <?php
    if (isset($error)) { ?>
        <small style="color:#aa0000;"><?php echo $error; ?></small>
        <br /><br />
        <?php
    }
    ?>

    <form action="addNew.php" method="get" autocomplete="off">
        <input type="text" name="name" placeholder="Nombre">
        <input type="text" name="description" placeholder="Descripción">
        <input type="text" name="upload_date" placeholder="Dia de subida">
        <input type="text" name="image" placeholder="directorio de imagen">
        <input type="text" name="link" placeholder="Link hacia el fichero">
        <input type="number" name="active" placeholder="0 = falso; 1 = verdadero">
        <input type="submit" value="Añadir Noticia">
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