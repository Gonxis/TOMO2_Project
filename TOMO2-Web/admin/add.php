<?php

session_start();

include_once ('../includes/connection.php');

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {

    if (isset($_POST['guardar'])){

        if (isset($_FILES['image'])){

            $image['name'] = date('ymhis') . $_FILES['image']['name'];
            $image['directory'] = '../img_bbdd/';
            move_uploaded_file($_FILES['image']['tmp_name'], $image['directory'] . $image['name']);
            $directory = 'img_bbdd/' . $image['name'];
        } else {
            $image = 'img_bbdd/helados.jpg'; $directory = 'img_bbdd/helados.jpg';
        }

    }

    if (isset($_POST['name'], $_POST['description'], $_POST['category'], $_POST['subcategory'], $_POST['image'], $_POST['active'])){
    $name = $_POST['name'];
    $description = nl2br($_POST['description']);
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $image = $directory;
    $active = $_POST['active'];


    if (empty($name) or empty($description) or empty($category) or empty($subcategory)){
        $error = 'Hay algunos campos vacíos por rellenar. El único campo vacío aceptable es "imagen".';
    } else {

        $query = $pdo->prepare('INSERT INTO Productos (name, description, category, subcategory, image, active) VALUES (?, ?, ?, ?, ?, ?)');

        $query->bindValue (1, $name);
        $query->bindValue (2, $description);
        $query->bindValue (3, $category);
        $query->bindValue (4, $subcategory);
        $query->bindValue (5, $directory);
        $query->bindValue (6, $active);

        $query->execute();

        echo "<script type=\"text/javascript\">
            alert('Se ha añadido correctamente a la base de datos un nuevo producto');
            history.go(-2);
            </script>";
        exit;
    }
}
?>

    <html>
        <head>
            <title>Añadir Producto - Version editable</title>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
            <link href="../../Card-2/card-2.css" type="text/css" rel="stylesheet">
            <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">-->
            <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        </head>

        <body>
            <div class="container">
                <!--<a href="index.php" id="logo">CMS</a>-->

                <br />

                <h4>Añadir Producto</h4>

                <?php
                if (isset($error)) { ?>
                    <small style="color:#aa0000;"><?php echo $error; ?></small>
                    <br /><br />
                <?php
                }
                ?>

                <form action="add.php" method="post" autocomplete="off">
                    <input type="text" name="name" placeholder="Nombre">
                    <input type="text" name="description" placeholder="Descripción">
                    <input type="text" name="category" placeholder="Categoría">
                    <input type="text" name="subcategory" placeholder="Subcategoría">
                    <input type="file" name="image" placeholder="Directorio de imagen">
                    <input type="number" name="active" placeholder="0 = falso; 1 = verdad">
                    <input type="submit" name="guardar" value="Añadir Producto">
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
