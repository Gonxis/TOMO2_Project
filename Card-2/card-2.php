<?php session_start();
//require_once 'fbapp/fbConfig.php';
/*require_once 'googleapp/config.php';
if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
  // user already logged in the site
  header("location: ../../../TOMO 2 Web con Materialize/index.php");
}*/
?>

<!doctype html>
<html>
		<head>
		<meta charset="UTF-8">
		<meta name="google-signin-scope" content="profile email">
		<meta name="google-signin-client_id" content="348397258029-ktn0flglesb5ghi7nj50qmd4nmj9nj61.apps.googleusercontent.com">
		<title>Card 2</title>
		<link href="card-2.css" type="text/css" rel="stylesheet">
		<!-- <script src="js/card-2.js" type="text/javascript"></script> -->

		<!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>-->
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<!--<script src="//code.jquery.com/jquery-1.11.0.min.js"></script> -->

		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
		
        <script type="text/javascript" src="fbapp/fb.js"></script>
		</head>

		<body>
        <main id="container">
          <h2>Access point</h2>
          <div class="img-wrapper"> <img src="img/tomo2Inicio.jpg" alt="Just Background"> </div>
          <div style="padding-left:38%; padding-top:10px; padding-bottom:10px;">
          <?php if (isset($_SESSION['name'])) { /*var_dump ($_SESSION['datos']);*/ } else { ?><div class="fb-login-button" data-scope="public_profile,email" onlogin="checkLoginState();"></div><?php } ?>
          </div>
          <div style="padding-left:30%; padding-top:10px;" class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
         </main>
</body>
</html>
