<?php 
session_start();


require_once("fbRegistro.php");

$facebook = new Facebook\Facebook([
    'app_id' => '391126004384836',
    'app_secret' => '4c9c259cf2e6e49270550c4d96fb196b',
    'default_graph_version' => 'v2.5',
]);

$facebook_id = $facebook->getUser();



#Verifica el usuario
if ($facebook_id!=0){
	//CONNECT TO THE MYSQL SERVER

	// Create connection o      localhost
	$con=mysqli_connect("localhost","root","root","TOMO2");

	// Check connection
	if (mysqli_connect_errno()) {
    	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	//END CREATING CONNECTION //

	
	#Comprobar si el usuario existe
	$query = $mysqli->query("SELECT * FROM FacebookLogin WHERE id_fb = '$facebook_id'");
	$rows = $query->num_rows;
	
	if ($rows > 0){
		#El usuario ya existe
		$datos = $facebook->get("/me");
		//var_dump();
		#Obtenemos los datos del usuario de MySQL
		$datos = $query->fetch_array(MYSQLI_ASSOC);
		
		#Inicio de sesion
		$_SESSION["facebook_id"] = $facebook_id;
		$_SESSION["username"] = $datos["username"];
		$_SESSION["email"] = $datos["email"];
		$_SESSION["oauth_provider"] = $datos["oauth_provider"];
		$_SESSION["oauth_uid"] = $datos["oauth_uid"];
		} else {
			#El usuario no existe
			#Obtenemos los datos del usuario
			$datos = $facebook->get("/me");
				$username = $datos["username"];
				$email = $datos["email"];
				$oauth_provider = $datos["oauth_provider"];
				$oauth_uid = $datos["oauth_uid"];
			
			#Insertamos en la bbdd
			$insert_user = $mysqli->query("INSERT INTO FacebookLogin (id_fb, name, email, oauth_provider, oauth_uid) values ('$facebook_id', '$username', '$email', '$oauth_provider', '$oauth_uid')");
			
			#Iniciamos sesión
			$_SESSION["facebook_id"] = $facebook_id;
			$_SESSION["username"] = $username;
			$_SESSION["email"] = $email;
			$_SESSION["oauth_provider"] = $oauth_provider;
			$_SESSION["oauth_uid"] = $oauth_uid;
			}
	}
header ('location: ../../TOMO2-Web/index.php');
/* Lo hemos intentado
//conectamos cno la base de datos con nuestras credenciales host, usuario y password.
mysql_connect('localhost', 'root', 'root');

//Seleccionamos nuestra base de datos
mysql_select_db('TOMO2');

$query = mysql_query("SELECT * FROM FacebookLogin WHERE oauth_provider = 'facebook' AND oauth_uid = ". $user['id']);
$result = mysql_fetch_array($query);

if(empty($result)){
       $query = mysql_query("INSERT INTO FacebookLogin (oauth_provider, oauth_uid, name) VALUES ('facebook', {$user['id']}, '{$user['name']}')");
    $query = mysql_query("SELECT * FROM FacebookLogin WHERE id_fb = " . mysql_insert_id());
    $result = mysql_fetch_array($query);
}

//Comprobamos si el usuario existe
$query = mysql_query("SELECT * FROM FacebookLogin WHERE oauth_provider = 'facebook' AND oauth_uid = ". $user['id']);
$result = mysql_fetch_array($query);
//Si no existe, lo añadimos a la tabla “users”
if(empty($result)){
        $query = mysql_query("INSERT INTO FacebookLogin (oauth_provider, oauth_uid, name) VALUES ('facebook', {$user['id']}, '{$user['name']}')");
    $query = msyql_query("SELECT * FROM FacebookLogin WHERE id_fb = " . mysql_insert_id());
    $result = mysql_fetch_array($query);
}

if(!empty($user)){


    if(empty($result)){

    }

	// Crear los valores de la sesión con los datos de Facebook connect
    $_SESSION['id_fb'] = $result['id_fb'];
    $_SESSION['oauth_uid'] = $result['oauth_uid'];
    $_SESSION['oauth_provider'] = $result['oauth_provider'];
    $_SESSION['name'] = $result['name'];
}
*/
?>