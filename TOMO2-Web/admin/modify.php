<?php

session_start();

include_once ('../includes/connection.php');

if (isset($_SESSION['logged_in'])) {
    if (isset($_POST['name'], $_POST['description'], $_POST['category'], $_POST['subcategory'], $_POST['image'], $_POST['active'])){
        $name = $_POST['name'];
        $description = nl2br($_POST['description']);
        $category = $_POST['category'];
        $subcategory = $_POST['subcategory'];
        $image = $_POST['image'];
        $active = $_POST['active'];

        if (empty($name) or empty($description) or empty($category) or empty($subcategory)){
            $error = 'There are some fields empty. The only empty field accepted is "image" field';
        } else {
            $query = $pdo->prepare('UPDATE Productos name = ?, description = ?, category = ?, subcategory = ?, image = ?, active = ? WHERE id_product = ?');

            $query->bindValue (1, $name);
            $query->bindValue (2, $description);
            $query->bindValue (3, $category);
            $query->bindValue (4, $subcategory);
            $query->bindValue (5, $image);
            $query->bindValue (6, $active);

            $query->execute();

            header('Location: index.php');
        }
    }

    ?>

    <html>
    <head>
        <title>Modify product - editable Version</title>
    </head>

    <body>
    <div class="container">
        <a href="index.php" id="logo">CMS</a>

        <br />

        <h4>Modify Product</h4>

        <?php
        if (isset($error)) { ?>
            <small style="color:#aa0000;"><?php echo $error; ?></small>
            <br /><br />
        <?php
        }
        ?>

        <form action="modify.php" method="post" autocomplete="off">
            <input type="text" name="name" placeholder="name">
            <input type="text" name="description" placeholder="description">
            <input type="text" name="category" placeholder="category">
            <input type="text" name="subcategory" placeholder="subcategory">
            <input type="text" name="image" placeholder="image directory">
            <input type="number" name="active" placeholder="0 = false; 1 = true">
            <input type="submit" value="Modify product">
        </form>

    </div>
    </body>
    </html>

<?php
} else {
    header('location: index.php');
}

?>