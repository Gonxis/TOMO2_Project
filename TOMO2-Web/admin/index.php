<?php

session_start();

include_once ('../includes/connection.php');


//if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {
//if (isset($_SESSION['logged_in'])) {
?>

    <html>
    <head>
        <title>index - editable Version</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>

<body>
<div class="container">
    <a href="index.php" id="logo">CMS</a>

    <br/>

        <!--<ol>
            <li><a href="../PDO/ProductModel.php">Product</a></li>
            <li><a href="../PDO/ShopModel.php">Shop</a></li>
            <li><a href="../PDO/NewModel.php">News</a></li>
            <li><a href="../PDO/ContestModel.php">Contest</a></li>
            <li><a href="../PDO/AnswerModel.php">Answer</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ol>-->
        </div>
        </body>
        </html>

    <?php
    /*} else {

        if (isset($_POST['username'], $_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (empty($username) or empty($password)) {
                $error = 'All fields are required!';
            } else {
                $query = $pdo->prepare("SELECT * FROM FacebookLogin WHERE name = ? AND oauth_uid = ?");

                $query->bindValue(1, $username);
                $query->bindValue(2, $password);

                $query->execute();

                $num = $query->rowCount();

                if ($num == 1) {
                    //user entered correct details
                    $_SESSION['logged_in'] = true;
                    header('Location: index.php');
                    exit();
                } else {
                    //user entered false details
                    $error = 'Incorrect details!';
                }
            }
        }*/
    ?>
<!--
        <html>
        <head>
            <title>index - edited Version</title>
        </head>

        <body>
        <div class="container">
            <a href="index.php" id="logo">CMS</a>

            <br/><br/>

            <?php //if (isset($error)) { ?>
                <small style="color:#aa0000;"><?php //echo $error; ?></small>
                <br/><br/>
            <?php //} ?>

            <form action="index.php" method="post" autocomplete="off">
                <input type="text" name="username" placeholder="username"/>
                <input type="password" name="password" placeholder="password"/>
                <input type="submit" value="login"/>
            </form>
        </div>
        </body>
        </html>
-->
<?php
//}
?>
<?php
/*} else {
    echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
    exit;
} */
?>
