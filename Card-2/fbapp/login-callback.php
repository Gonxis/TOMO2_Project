<?php
session_start();
require_once __DIR__ . '/src/Facebook/autoload.php';
//require_once 'fbConfig.php';

$fb = new Facebook\Facebook([
  'app_id' => '391126004384836',
  'app_secret' => '4c9c259cf2e6e49270550c4d96fb196b',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getJavaScriptHelper();

try {
  $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

if (isset($accessToken)) {
   $fb->setDefaultAccessToken($accessToken);

  try {
    
	//$_SESSION['datos'] = $fb->api("/me");
    $requestProfile = $fb->get("/me?fields=name,email");
    $profile = $requestProfile->getGraphNode()->asArray();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
  }

  $user['name'] = $_SESSION['name'] = $profile['name'];
  $_SESSION['datos'] = $fb->get("/me");
  $user['id'] = $_SESSION['id'] = $profile['id'];
  $user['email'] = $profile['email'];
  //$datos = $fb->api("/me");
  //var_dump ($datos);
  //require_once 'fbConfig.php';


    //CONNECT TO THE MYSQL SERVER

    // Create connection o      localhost
    $con=mysqli_connect("localhost","root","root","TOMO2");
    //echo '<script language="javascript">alert("Creo la conexión");</script>';

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        //echo '<script language="javascript">alert("Entro en fallo");</script>';
    }

    //END CREATING CONNECTION //

/*
    #Comprobar si el usuario existe
    $query = mysqli_query($con, "SELECT * FROM FacebookLogin WHERE id_fb = '$id'");
    $rows = mysqli_num_rows($query);

    if ($rows > 0){
        #El usuario ya existe
        echo '<script language="javascript">alert("El usuario ya existe");</script>';

        $datos = $fb->get("/me");
        //var_dump();
        #Obtenemos los datos del usuario de MySQL
        $datos = $query->fetch_array(MYSQLI_ASSOC);

        #Inicio de sesion
        $_SESSION["id"] = $id;
        $_SESSION["username"] = $datos["username"];
        $_SESSION["email"] = $datos["email"];
        $_SESSION["oauth_provider"] = $datos["oauth_provider"];
        $_SESSION["oauth_uid"] = $datos["oauth_uid"];


    } else {
        #El usuario no existe
        #Obtenemos los datos del usuario
        echo '<script language="javascript">alert("El usuario no existe en la bbdd");</script>';

        $datos = $fb->get("/me");
        $username = $datos["username"];
        $email = $datos["email"];
        $oauth_provider = $datos["oauth_provider"];
        $oauth_uid = $datos["oauth_uid"];

        #Insertamos en la bbdd
        $insert_user = mysqli_query($con, "INSERT INTO FacebookLogin (id_fb, name, email, oauth_provider, oauth_uid) values ('$id', '$username', '$email', '$oauth_provider', '$oauth_uid')");

        #Iniciamos sesión
        $_SESSION["id"] = $id;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["oauth_provider"] = $oauth_provider;
        $_SESSION["oauth_uid"] = $oauth_uid;

        echo '<script language="javascript">alert("En principio inserto bien en la bbdd");</script>';
    } */


    //SELECT * FROM `FacebookLogin` WHERE oauth_provider = 'facebook' AND oauth_uid = 10207674962976867
    $query = mysqli_query($con, "SELECT * FROM FacebookLogin WHERE oauth_provider = 'facebook' AND oauth_uid = '". $user['id'] . "'");
    //$result = mysqli_fetch_array($con, $result);
    $result = mysqli_fetch_array($query, MYSQLI_BOTH);
    //$rows = mysqli_num_rows($query);

    //if ($rows == 0){
    if ($result == 0){
    //if(empty($result)){
        //echo '<script language="javascript">alert("El usuario no existe en la bbdd y lo añadimos acto seguido");</script>';
        $query = mysqli_query($con, "INSERT INTO FacebookLogin (id_fb, name, email, oauth_provider, oauth_uid) VALUES ('', '{$user['name']}', '{$user['email']}', 'facebook', '{$user['id']}')");
        $result = mysqli_query($con, "SELECT * FROM FacebookLogin WHERE oauth_uid = '{$user['id']}'");
        //$result = mysql_fetch_array($query);
    }

/*
 *
//Comprobamos si el usuario existe
    $query = mysql_query("SELECT * FROM FacebookLogin WHERE oauth_provider = 'facebook' AND oauth_uid = ". $user['id']);
    $result = mysql_fetch_array($query);
//Si no existe, lo añadimos a la tabla “users”
    if(empty($result)){
        $query = mysql_query("INSERT INTO FacebookLogin (oauth_provider, oauth_uid, name) VALUES ('facebook', {$user['id']}, '{$user['name']}')");
        $query = msyql_query("SELECT * FROM FacebookLogin WHERE id_fb = " . mysql_insert_id());
        $result = mysql_fetch_array($query);
    }
*/
    if(!empty($user)){
        /*
        echo '<script language="javascript">alert("No está vacia la variable $user");</script>';

        echo '<script language="javascript">alert("La variable $user contiene lo siguiente: ';
        echo $user;
        echo '");</script>';

        echo '<script language="javascript">alert("La variable $user[id] = ';
        echo $user['id'];
        echo '");</script>';

        echo '<script language="javascript">alert(", la variable $user[name] = ';
        echo $user['name'];
        echo '");</script>';

        echo '<script language="javascript">alert("Y la variable $user[email] = ';
        echo $user['email'];
        echo '");</script>';
        */

        if(empty($result)){
            /*
            echo '<script language="javascript">alert("La variable $result esta vacia: ';
            echo $result;
            echo '");</script>';
            echo '<script language="javascript">alert("No se han introducido datos en la bbdd porque la variable está vacia..");</script>';
            */
        }

        // Crear los valores de la sesión con los datos de Facebook connect
        $_SESSION['id_fb'] = $result['id_fb'];
        $_SESSION['oauth_uid'] = $result['oauth_uid'];
        $_SESSION['oauth_provider'] = $result['oauth_provider'];
        $_SESSION['name'] = $result['name'];

    }

    mysqli_close($con);


    echo '<script language="javascript">alert("Estoy en el nivel del header, pero no me redirecciona, no se porque..");</script>';
  //setcookie('name', $profile['name'], time() + (3600 * 2), "/");
  //header('location: ../index.php');
  header('location: ../../TOMO 2 Web con Materialize/index.php');
  //header('location: ../card-2.php');

  exit;
} else {
    echo "Unauthorized access!!!";
    exit;
}
