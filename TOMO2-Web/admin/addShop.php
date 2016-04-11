<?php

session_start();

include_once ('../includes/connection.php');

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {
if (isset($_GET['name'], $_GET['description'], $_GET['tel_number'], $_GET['iframe'], $_GET['image'], $_GET['active'])){
    $name = $_GET['name'];
    $description = nl2br($_GET['description']);
    $tel_number = $_GET['tel_number'];
    $iframe = $_GET['iframe'];
    $image = $_GET['image'];
    $active = $_GET['active'];

    if (empty($name) or empty($description) or empty($tel_number)){
        $error = 'Hay algunos campos vacíos. Los únicos campos vacíos aceptables son "iframe" e "imagen"';
    } else {
        $query = $pdo->prepare('INSERT INTO Tiendas (name, description, tel_number, iframe, image, active) VALUES (?, ?, ?, ?, ?, ?)');

        $query->bindValue (1, $name);
        $query->bindValue (2, $description);
        $query->bindValue (3, $tel_number);
        $query->bindValue (4, $iframe);
        $query->bindValue (5, $image);
        $query->bindValue (6, $active);

        $query->execute();

        echo "<script type=\"text/javascript\">
            alert('Se ha añadido correctamente a la base de datos una nueva tienda');
            history.go(-2);
            </script>";
        exit;
    }
}
?>

<html>
<head>
    <title>Añadir tienda - Version editable</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>

<body>
<div class="container">
    <!--<a href="index.php" id="logo">CMS</a>-->

    <br />

    <h4>Añadir Tienda</h4>

    <?php
    if (isset($error)) { ?>
        <small style="color:#aa0000;"><?php echo $error; ?></small>
        <br /><br />
        <?php
    }
    ?>

    <form action="add.php" method="get" autocomplete="off">
        <input type="text" name="name" placeholder="Nombre">
        <input type="text" name="description" placeholder="Descripción">
        <input type="text" name="tel_number" placeholder="Número de teléfono">
        <input type="text" name="iframe" placeholder="URL al mapa de Google con la ubicación de la tienda">
        <input type="text" name="image" placeholder="Directorio de imagen">
        <input type="number" name="active" placeholder="0 = falso; 1 = verdad">
        <input type="submit" value="Añadir Producto">
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

