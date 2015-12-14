<?php session_start();
$conn = mysqli_connect("localhost", "root", "root", "TOMO2");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>Tomo 2, Helados Naturales</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<div class="navbar-fixed">
    <nav class="red accent-4">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"><i
                    class="material-icons left"><img src="img/Logo_Tomo2_.png" height="55px" width="55px"></i>TOMO 2</a>
            <ul class="right hide-on-med-and-down">
                <li class="active"><a href="#ourShops">Tiendas</a></li>
                <li><a href="#bookings">Alquileres</a></li>
                <li><a href="#productos">Productos</a></li>
                <li><a href="#contactUs">Contacto</a></li>
                <!--<li><a href="#">Horarios</a></li>-->
                <li><a href="#news">Noticias</a></li>
                <?php if (isset($_SESSION['name'])) { /*var_dump ($_SESSION['datos']);*/ } else { ?><div class="fb-login-button" data-scope="public_profile,email" onlogin="checkLoginState();"></div><?php } ?>

            </ul>
            <ul id="nav-mobile" class="side-nav red accent-4">
                <li class="active"><a href="#" class="white-text"> <i class="material-icons">home</i> Inicio</a></li>
                <li><a href="#ourShops" class="white-text"> <i class="material-icons">place</i> Tiendas</a></li>
                <li><a href="#bookings" class="white-text"> <i class="material-icons">event</i> Alquileres</a></li>
                <li><a href="#productos" class="white-text"> <i class="material-icons">shopping_basket</i>Productos</a>
                </li>
                <li><a href="#contactUs" class="white-text"> <i class="material-icons">send</i> Contacto</a></li>
                <!--<li><a href="#">Horarios</a></li>-->
                <li><a href="#news" class="white-text"> <i class="material-icons">library_books</i>Noticias</a></li>
                <!--<li><a href="#editProfile" class="white-text"> <i class="material-icons">edit</i> Edit your profile</a></li>-->
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a></div>
    </nav>
</div>
<div id="index-banner" class="parallax-container"
     style="background-image:url(img/fondoInicial.jpg); background-repeat:repeat">
    <div class="section no-pad-bot">
        <div class="container"><br>
            <br>
            <h6 class="header center white-text text-lighten-1"></h6>

            <h1 class="header center white-text text-lighten-1">Helados Naturales</h1>

            <div class="row center">
                <h5 class="header col s12 light"></h5>
                <img src="img/Logo_Tomo2_.png" alt="logotipo" height="200px" width="200px"/></div>
            <br>
            <br>
        </div>
    </div>
    <div class="parallax">
        <!-- <video id="video" autoplay preload="auto" loop>
             <source src="videos/video1_1.mp4" type="video/mp4"></source>
        </video> -->
    </div>
</div>
<div class="container">
    <div class="section">

        <!--   Icon Section   -->
        <div class="row">
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center grey-text"><i class="material-icons">nature</i></h2>
                    <h5 class="center red-text">Helados 100% naturales</h5>

                    <p class="light grey-text">Los helados TOMO 2, helados de elaboración propia, están hechos de forma
                        totalmente natural, sin conservante ni colorantes, de forma artesanal cuidando de nuestros
                        clientes y haciendo que cualquier persona pueda disfrutar de un producto único. Porque... ¡todo
                        el <font color="#F44336">mundo </font> tiene derecho a un <font color="#F44336">buen
                            helado!</font></p>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center grey-text"><i class="material-icons">plus_one</i></h2>
                    <h5 class="center red-text">Experiencia de más de 10 años</h5>

                    <p class="light grey-text">La empresa TOMO 2 se constituyó en el año 2004, con años de experiencia
                        en el sector heladero.</p>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center grey-text"><i class="material-icons">info</i></h2>
                    <h5 class="center red-text">Creación de helados a tu gusto</h5>

                    <p class="light grey-text">TOMO 2 hace cualquier tipo de helados que te puedas imaginar, tanto dulce
                        como salado. Si tienes en tu mente un helado en concreto que no hayas visto aún en nuestras
                        vitrinas, pásate por nuestras tiendas o bien envíanos un correo a la dirección de correo <a
                            href="mailto:teresa@tomodos.com">info@tomodos.com</a> o directamente desde esta web, al
                        apartado <a href="#contactUs">Contáctenos</a> y te informaremos de lo que necesites saber.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Our shops-->
<?php
//$sql = "SELECT * FROM Productos WHERE subcategory = 'Crema'";
$sql = "SELECT * FROM Tiendas";
$result = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($result);

if (mysqli_num_rows($result) > 0) {
// output data of each row
?>

    <div id="ourShops" class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12 red-text light">Nuestras tiendas</h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="img/background10.png" alt="Localización de la tienda de la calle Vic, Gracia">
        </div>
    </div>
<div class="container">
<div class="section">
<div class="row">
<div class="col s12 center">
<h3><i class=" mdi-action-store grey-text"></i></h3>
<h4>Nuestras tiendas</h4>
<h5 class="red-text light">¡Te desvelamos nuestras tiendas en Google Maps para que no tengas que hacer ningún
    esfuerzo!</h5>
<br>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <!--echo "id: " . $row["id_shop"] . " - Name: " . $row["name"] . " - Description: " . $row["description"] . " - Tel. num: " . $row["tel_number"]. "<br>";-->
    <div class="slider">
        <ul class="slides">
            <li><img src="img/Vic1.jpg" alt="Vic1[punto]jpg">

                <div class="caption right-align">
                    <h3></h3>
                    <h5 class="light grey-text text-lighten-3"><?php echo $row["description"] . " " . $row["tel_number"]; ?></h5>
                </div>
            </li>
            <li><img src="img/Vic2.jpg" alt="Vic2[punto]jpg">

                <div class="caption left-align">
                    <h3></h3>
                    <h5 class="light grey-text text-lighten-3"><?php echo $row["description"] . " " . $row["tel_number"]; ?></h5>
                </div>
            </li>
            <li><img src="img/Vic3.jpg" alt="Vic3[punto]jpg">

                <div class="caption right-align">
                    <h3></h3>
                    <h5 class="light grey-text text-lighten-3"><?php echo $row["description"] . " " . $row["tel_number"]; ?></h5>
                </div>
            </li>
        </ul>
    </div>
    <!--<p class="center-align grey-text light">Carrer de Vic, 2, Gracia, 08006 Barcelona. 932 173 192 </p>
    --><br>
    <?php if (!empty($row["iframe"])) { ?>

        <div class="google-maps">
            <iframe src=<?php echo $row["iframe"]; ?></iframe>

        </div>
        <br>
        <br>

    <?php
    }
}
?>
<!--
<div class="slider">
  <ul class="slides">
    <li> <img src="img/Vic1.jpg" alt="Vic1[punto]jpg">
      <div class="caption center-align">
        <h3></h3>
        <h5 class="light grey-text text-lighten-3">Carrer de Vic, 2, Gracia, 08006 Barcelona. 932 173 192</h5>
      </div>
    </li>
    <li> <img src="img/Vic2.jpg" alt="Vic2[punto]jpg">
      <div class="caption left-align">
        <h3>Carrer de Vic, 2, Gracia, 08006 Barcelona. 932 173 192</h3>
        <h5 class="light grey-text text-lighten-3"></h5>
      </div>
    </li>
    <li> <img src="img/Vic3.jpg" alt="Vic3[punto]jpg">
      <div class="caption right-align">
        <h3>Carrer de Vic, 2, Gracia, 08006 Barcelona. 932 173 192</h3>
        <h5 class="light grey-text text-lighten-3"></h5>
      </div>
    </li>
  </ul>
</div>
<!--<p class="center-align grey-text light">Carrer de Vic, 2, Gracia, 08006 Barcelona. 932 173 192 </p>
       <br>
<div class="google-maps">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2992.8717633098972!2d2.1555656999999986!3d41.39859119999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4a29781519389%3A0x63feb527343ec099!2sTomo+II+-+Helados+naturales!5e0!3m2!1ses!2ses!4v1440936419080" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<br>
<br>

<!--<img class="materialboxed" width="100%" data-caption="Tienda de la calle Argentería 61" src="img/Argenteria1.jpg">-->
<!--
<div class="slider">
  <ul class="slides">
    <li> <img src="img/Borne1.jpg" alt="img/Borne1[punto]jpg">
      <div class="caption center-align">
        <h3>Carrer de l'Argenteria 61, Barrio Gótico, 08003 Barcelona. 933 197 739</h3>
        <h5 class="light grey-text text-lighten-3"></h5>
      </div>
    </li>
    <li> <img src="img/Borne2.jpg" alt="img/Borne2[punto]jpg">
      <div class="caption left-align">
        <h3>Carrer de l'Argenteria 61, Barrio Gótico, 08003 Barcelona. 933 197 739</h3>
        <h5 class="light grey-text text-lighten-3"></h5>
      </div>
    </li>
    <li> <img src="img/Borne3.jpg" alt="img/Borne3[punto]jpg">
      <div class="caption right-align">
        <h3>Carrer de l'Argenteria 61, Barrio Gótico, 08003 Barcelona. 933 197 739</h3>
        <h5 class="light grey-text text-lighten-3"></h5>
      </div>
    </li>
  </ul>
</div>
<!--<p class="center-align grey-text light">Carrer de l'Argenteria 61, Barrio Gótico, 08003 Barcelona. 933 197 739 </p>
      <br>
<div class="google-maps">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2993.5621634874515!2d2.1810929999999993!3d41.383596399999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4a2fee44d02b5%3A0xc44e9e85d34eadda!2sTomo+II+-+Helados+naturales!5e0!3m2!1ses!2ses!4v1440937520369" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<br>
<br>
<div class="slider">
  <ul class="slides">
    <li> <img src="img/Galvany1.jpg" alt="Galvany1[punto]jpg">
      <div class="caption center-align">
        <h3>Marià Cubí, 156, (esquina Santaló), Sant Gervasi - Sarrià, 08021 Barcelona. 932 528 973</h3>
        <h5 class="light grey-text text-lighten-3"></h5>
      </div>
    </li>
    <li> <img src="img/Galvany2.jpg" alt="Galvany2[punto]jpg">
      <div class="caption left-align">
        <h3>Marià Cubí, 156, (esquina Santaló), Sant Gervasi - Sarrià, 08021 Barcelona. 932 528 973</h3>
        <h5 class="light grey-text text-lighten-3"></h5>
      </div>
    </li>
    <li> <img src="img/Galvany3.jpg" alt="Galvany3[punto]jpg">
      <div class="caption right-align">
        <h3>Marià Cubí, 156, (esquina Santaló), Sant Gervasi - Sarrià, 08021 Barcelona. 932 528 973</h3>
        <h5 class="light grey-text text-lighten-3"></h5>
      </div>
    </li>
  </ul>
</div>
<!--<p class="center-align grey-text light">Marià Cubí, 156, (esquina Santaló), Sant Gervasi - Sarrià, 08021 Barcelona. 932 528 973</p>
    <br>
<div class="google-maps">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2993.001456454466!2d2.1454212069511405!3d41.39577473448008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x4c79f744c10c71d5!2sHelader%C3%ADa+Tomo+II+Galvany!5e0!3m2!1ses!2ses!4v1440937821751" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<br>
<div class="slider">
  <ul class="slides">
    <li> <img src="img/MajorDeSarria4.jpg" alt="MajorDeSarria4[punto]jpg">
      <div class="caption center-align">
        <h3>Tienda de la calle Major de Sarrià, 75, Sarrià, Barcelona. 932 804 298</h3>
        <h5 class="light grey-text text-lighten-3"></h5>
      </div>
    </li>
    <li> <img src="img/Sarria2.jpg" alt="Sarria2[punto]jpg">
      <div class="caption left-align">
        <h3>Tienda de la calle Major de Sarrià, 75, Sarrià, Barcelona. 932 804 298</h3>
        <h5 class="light grey-text text-lighten-3"></h5>
      </div>
    </li>
    <li> <img src="img/MajorDeSarria5.png" alt="MajorDeSarria5[punto]png">
      <div class="caption right-align">
        <h3>Tienda de la calle Major de Sarrià, 75, Sarrià, Barcelona. 932 804 298</h3>
        <h5 class="light grey-text text-lighten-3"></h5>
      </div>
    </li>
  </ul>
</div>
<br>
    <br>
<br> -->

<?php
} else {
    echo "Error al consultar la tabla Tiendas de la bbdd";
}
?>

<h5 class="red-text light">Puntos de venta alternativos donde poder disfrutar de nuestros helados</h5>
<!--Fisrt card-->
<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card1.jpg" alt="Card1[punto]jpg"> <span class="card-title">Dolç de llet</span>
            </div>
            <div class="card-content">
                <p>En la calle Josep Anseim Clavé, 29, Barrio Gótico de Barcelona, hallamos esta tienda tan peculiar,
                    que además de un magnífico café, encontrarás una vitrina con nuestros helados.</p>
            </div>
            <!--<div class="card-action"> <a href="https://www.facebook.com/dolcdellet.d.dolcdellet">Visita su Facebook</a> </div>-->
        </div>
    </div>
    <!--First card-->

    <!--Second card-->
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card2.jpg" alt="Card2[punto]jpg"> <span class="card-title">Bready &amp; casual.</span>
            </div>
            <div class="card-content">
                <p>En Travessera de Dalt, 29, Barcelona, encontrarás esta tienda con unos fantásticos bocadillos, zumos
                    de frutas naturales y nuestros deliciosos helados naturales.</p>
            </div>
            <!--<div class="card-action"> <a href="http://breadyandcasualfood.com/es/">Visita su web</a> </div>-->
        </div>
    </div>
</div>
<!--Second card-->

<!--Third card-->
<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card3.jpg" alt="Card3[punto]jpg"> <span
                    class="card-title">La Caleta</span></div>
            <div class="card-content">
                <p>El restaurante La Caleta, en Sitges, además de una estupenda comida, disfrutarás de un maravilloso
                    postre.</p>
            </div>
            <!--<div class="card-action"> <a href="http://lacaletadesitges.es/">Visita su web</a> </div>-->
        </div>
    </div>
    <!--Third card-->

    <!--Fourth card-->
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card4.jpg" alt="Card4[punto]jpg"> <span
                    class="card-title">El Cèntric</span></div>
            <div class="card-content">
                <p>Rambla Nostra Senyora 10, Vilafranca del Penedès, Barcelona. Cuenta con una estupenda cocina
                    combinada con un fantástico postre helado. </p>
            </div>
            <!--<div class="card-action"> <a href="http://www.centricgastrobar.es/">Visita su web</a> </div>-->
        </div>
    </div>
</div>
<!--Fourth card-->

<!--Fifth card-->
<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card5.jpg" alt="Card5[punto]jpg"> <span
                    class="card-title">Your Burg</span></div>
            <div class="card-content">
                <p>En este restaurante del barrio de Les Corts, Barcelona, en la calle De Londres, 65, degustarás las
                    mejores hamburguesas de Barcelona y nuestros mejores helados naturales.</p>
            </div>
            <!--<div class="card-action"> <a href="http://yours.cat/">Visita su web</a> </div>-->
        </div>
    </div>
    <!--Fifth card-->

    <!--Sixth card-->
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card6.jpg" alt="Card6[punto]jpg"> <span
                    class="card-title">Mama's Cafe</span></div>
            <div class="card-content">
                <p>Carrer de Torrijos, 26, Barcelona. Un lugar encantador para tomar algo a cualquier hora del día.</p>
            </div>
            <!--<div class="card-action"> <a href="http://www.mamascafebcn.com/">Visita su web</a> </div>-->
        </div>
    </div>
</div>
<!--Sixth card-->

<!--Seventh card-->
<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Palamos5.jpg" alt="img/Palamos5[punto]jpg"> <span class="card-title">Gelatería del passeig</span>
            </div>
            <div class="card-content">
                <p>Alejandra y Carlos hicieron de esta esquinita un lugar idílico para tomar, relajadamente frente al
                    mar, un fantástico helado natural TOMO 2.</p>
            </div>
            <!--<div class="card-action"> <a href="">Visita su web</a> </div>-->
        </div>
    </div>
    <!--Seventh card-->

    <!--Eighth card-->
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Far1.jpg" alt="img/Far1[punto]jpg"> <span class="card-title">Far de San Sebastián</span>
            </div>
            <div class="card-content">
                <p>En este emblemático lugar, además de unas fantásticas vistas, podrás disfrutar de una exquisita
                    comida y uno de nuestros helados creados especialmente para ellos.</p>
            </div>
            <!--<div class="card-action"> <a href="http://www.farnomo.com/es">Visita su web</a> </div>-->
        </div>
    </div>
</div>
<!--Eighth card-->

<!--Ninth card-->
<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card7.jpg" alt="img/Card7[punto]jpg"> <span
                    class="card-title">Nomo</span></div>
            <div class="card-content">
                <p>El restaurante Nomo, un restaurante japonés situado en Carrer Gran de Gràcia, 13, Barcelona cuenta
                    con unos estupendos helados naturales TOMO 2 hechos a su medida.</p>
            </div>
            <!--<div class="card-action"> <a href="http://www.restaurantenomo.com/es">Visita su web</a> </div>-->
        </div>
    </div>
    <!--Ninth card-->

    <!--Tenth card-->
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card8.jpg" alt="img/Card8[punto]jpg"> <span
                    class="card-title">Kuo</span></div>
            <div class="card-content">
                <p> El restaurante Kuo, del grupo nomo, un restaurante japonés situado en Carrer Madrazo, 135, Barcelona
                    cuenta también con nuestros helados naturales.</p>
            </div>
            <!--<div class="card-action"> <a href="http://www.restaurantekuo.com/es">Visita su web</a> </div>-->
        </div>
    </div>
</div>
<!--Tenth card-->

<!--Eleventh card-->
<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card9.jpg" alt="img/Card9[punto]jpg"> <span class="card-title">Nomo Market</span>
            </div>
            <div class="card-content">
                <p>El restaurante Nomo Market, del grupo nomo, un restaurante japonés situado en C/ Madrazo, 137,
                    Barcelona cuenta con unos estupendos helados naturales hechos a su medida sólo para llevar.</p>
            </div>
            <!--<div class="card-action"> <a href="http://www.nomomarket.com/es">Visita su web</a> </div>-->
        </div>
    </div>
    <!--Eleventh card-->

    <!--Twelfth card-->
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card10.jpg" alt="img/Card10[punto]jpg"> <span
                    class="card-title">Umo</span></div>
            <div class="card-content">
                <p>El restaurante Umo, del grupo nomo, un restaurante japonés situado en Hotel Catalonia Barcelona,
                    Plaça d'Espanya, 6- 8, Barcelona cuenta con nuestros helados naturales TOMO 2.</p>
            </div>
            <!--<div class="card-action"> <a href="http://www.restauranteumo.com/es">Visita su web</a> </div>-->
        </div>
    </div>
</div>
<!--Twelfth card-->

<!--Thirdeenth card-->
<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card11.jpg" alt="img/Card11[punto]jpg"> <span
                    class="card-title">Ítaka</span></div>
            <div class="card-content">
                <p>La tabernita Ítaka cuenta con alguna variedad de nuestros helados en su carta de postres está situada
                    en Passeig de Pujades nº21, Barcelona</p>
            </div>
            <!--<div class="card-action"> <a href="http://itakabarcelona.com/">Visita su web</a> </div>-->
        </div>
    </div>
    <!--Thirdeenth card-->

    <!--Twelfth card-->
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image"><img src="img/Card12.jpg" alt="img/Card12[punto]jpg"> <span
                    class="card-title"></span></div>
            <div class="card-content">
                <p>Ahora, pedir tu helado TOMO 2 es cada vez más fácil. Sólo tienes que hacer click en el link de abajo
                    para pedirlo desde casa o cualquier sitio y que te lo traigan.</p>
            </div>
            <div class="card-action"><a
                    href="https://www.laneveraroja.com/restaurant/n7ax/heladeria-tomo-dos-vila-de-gracia"
                    target="_blank">¡Píde en casa!</a></div>
        </div>
    </div>
</div>
<!--Twelfth card-->

</div>
</div>
</div>
</div>
<!--Our Shops-->

<!--Bookings-->
<div id="bookings" class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 red-text light">Alquileres</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="img/Alquiler1.jpg" alt="Localización de la tienda de la calle Vic, Gracia"></div>
</div>
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12 center">
                <h3><i class=" mdi-action-event brown-text"></i></h3>
                <h4>Alquileres</h4>
                <h5 class="red-text light">Tomo 2 ofrece diferentes vitrinas para alquilar en cualquier momento del año.
                    Si estás organizando un evento como... una fiesta de cumpleaños, boda, comunión, bautizo…, sorprende
                    a tus invitados con alguno de nuestros carritos de helados, creppes o fuente de chocolate.</h5>
                <br>

                <div class="slider">
                    <ul class="slides">
                        <li><img src="img/Alquiler17.jpg" alt="img/Alquiler17[punto]jpg">

                            <div class="caption center-align">
                                <h3></h3>
                                <h5 class="light grey-text text-lighten-3"></h5>
                            </div>
                        </li>
                        <li><img src="img/Alquiler18.jpg" alt="img/Alquiler18[punto]jpg">

                            <div class="caption center-align">
                                <h3></h3>
                                <h5 class="light grey-text text-lighten-3"></h5>
                            </div>
                        </li>
                        <li><img src="img/Alquiler3.jpg" alt="img/Alquiler3[punto]jpg">

                            <div class="caption center-align">
                                <h3></h3>
                                <h5 class="light grey-text text-lighten-3"></h5>
                            </div>
                        </li>
                        <li><img src="img/Alquiler4.jpg" alt="img/Alquiler4[punto]jpg">

                            <div class="caption left-align">
                                <h3></h3>
                                <h5 class="light grey-text text-lighten-3"></h5>
                            </div>
                        </li>
                        <li><img src="img/Alquiler10.jpg" alt="img/Alquiler10[punto]jpg">

                            <div class="caption right-align">
                                <h3></h3>
                                <h5 class="light grey-text text-lighten-3"></h5>
                            </div>
                        </li>
                        <li><img src="img/Alquiler14.jpg" alt="img/Alquiler14[punto]jpg">

                            <div class="caption right-align">
                                <h3></h3>
                                <h5 class="light grey-text text-lighten-3"></h5>
                            </div>
                        </li>
                    </ul>
                </div>
                <br>

                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light"><img class="activator"
                                                                                      src="img/Alquiler2.jpg"
                                                                                      alt="img/Alquiler2[punto]jpg">
                    </div>
                    <div class="card-content"><span class="card-title activator grey-text text-darken-4">Vitrina de helados<i
                                class="material-icons right">more_vert</i></span>

                        <p><a href="#"></a></p>
                    </div>
                    <div class="card-reveal"><span class="card-title grey-text text-darken-4">Alquiler de vitrina de helados<i
                                class="material-icons right">close</i></span>

                        <p>Vitrina con 4 sabores de helados que puedes elegir a tu antojo con personal y material
                            incorporado.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light"><img class="activator"
                                                                                      src="img/Alquiler16.jpg"
                                                                                      alt="img/Alquiler16[punto]jpg">
                    </div>
                    <div class="card-content"><span class="card-title activator grey-text text-darken-4">Carrito con fuente de chocolate<i
                                class="material-icons right">more_vert</i></span>

                        <p><a href="#"></a></p>
                    </div>
                    <div class="card-reveal"><span class="card-title grey-text text-darken-4">Carrito con fuente de chocolate<i
                                class="material-icons right">close</i></span>

                        <p></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light"><img class="activator"
                                                                                      src="img/Alquiler1.jpg"
                                                                                      alt="img/Alquiler1[punto]jpg">
                    </div>
                    <div class="card-content"><span class="card-title activator grey-text text-darken-4">Carrito con creppera<i
                                class="material-icons right">more_vert</i></span>

                        <p><a href="#"></a></p>
                    </div>
                    <div class="card-reveal"><span class="card-title grey-text text-darken-4">Carrito con creppera<i
                                class="material-icons right">close</i></span>

                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Bookings-->

<!--Products-->
<div id="productos" class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 red-text light">Productos</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="img/Producto1.jpg" alt="Localización de la tienda de la calle Vic, Gracia"></div>
</div>
<div class="container"> <!--Aqui tendría que ir una imagen con fondo otoñal-->
<div class="section">
<div class="row">
<div class="col s12 center">
<h3><i class=" mdi-action-store brown-text"></i></h3>
<h4>Nuestros productos</h4>
<h5 class="red-text light">Sabores de helados</h5>

<div class="row">
    <div class="input-field col s4">
        <select multiple>
            <optgroup label="Helados">
                <!--<option value="" disabled selected>Choose a category</option> -->
                <option value="1" selected>Crema</option>
                <option value="2">Sorbete</option>
            </optgroup>
            <optgroup label="Repostería">
                <option value="3">Galleta</option>
                <option value="4">Tartas</option>
            </optgroup>
            <optgroup label="Otros">
                <option value="5">Otros</option>
            </optgroup>
            <optgroup label="Bebidas">
                <option value="6">Bebidas</option>
            </optgroup>
        </select>
        <label>Categoría</label>
    </div>

    <div class="col s8">
        <form>
            <div class="input-field">
                <input id="search" type="search" placeholder="Busca por productos..." required>
                <label for="search"><i class="material-icons">search</i></label>
                <!--<i class="material-icons red-text">close</i>-->
            </div>
        </form>
    </div>
</div>

<?php

//$sql = "SELECT * FROM Productos WHERE subcategory = 'Crema'";
$sql = "SELECT * FROM Productos";
$result = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($result);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        //if no es el último registro hacer esto // if ($row != $numRows)
        if ($row["id_product"] % 2 == 0) {
            ?>
            <div class="row">
            <div class="col s6 m6 l6">
                <div class="card">
                    <div class="card-image"><img src="<?php echo $row["image"]; ?>"
                                                 alt="<?php echo $row["image"]; ?>"><span
                            class="card-title"><?php echo $row["name"]; ?></span></div>
                    <div class="card-content">
                        <p><?php echo $row["description"]; ?></p>
                    </div>
                </div>
            </div>
        <?php
        } else {
            ?>

            <div class="col s6 m6 l6">
                <div class="card">
                    <div class="card-image"><img src="<?php echo $row["image"]; ?>"
                                                 alt="<?php echo $row["image"]; ?>"><span
                            class="card-title"><?php echo $row["name"]; ?></span></div>
                    <div class="card-content">
                        <p><?php echo $row["description"]; ?></p>
                    </div>
                </div>
            </div>
            </div>
        <?php
        }
        //else (es el último regstro) { <div class="row"> <div class="col s6"> <div class="card"> ... </div> </div> </div> }
        //echo "id: " . $row["id_product"] . " - Name: " . $row["name"] . " - Description: " . $row["description"] . " - Category: " . $row["category"] . " - Subcategory: " . $row["subcategory"] . "<br>";
    }
} else {
    echo "Problemas al obtener los Productos de la bbdd";
}

?>

<!--   <ul class="collapsible popout" data-collapsible="accordion">
     <li> <a class="collapsible-header">Cremas<i class="mdi-navigation-arrow-drop-down"></i></a>
       <div class="collapsible-body">
         <ul>
           <li>Avellana</li>
           <li>After Eight</li>
           <li>Café</li>
           <li>Chocolate amargo</li>
           <li>Chocolate con leche</li>
           <li>Nutella</li>
           <li>Chocolate blanco</li>
           <li>Coco</li>
           <li>Crema catalana</li>
           <li>Crema de fresas</li>
           <li>Yogurt con coulis de frambuesa</li>
           <li>Dulce de leche</li>
           <li>Leche merengada</li>
           <li>Mascarpone con frutas del bosque</li>
           <li>Pistacho</li>
           <li>Ferrero Rocher</li>
           <li>Ron con pasas</li>
           <li>Ratafía de L'Empordà</li>
           <li>Oreo</li>
           <li>Taro</li>
           <li>Té verde</li>
           <li>Sésamo negro</li>
           <li>Strachiattella</li>
           <li>Turrón</li>
           <li>Tiramisú</li>
           <li>Vainilla</li>
           <li>Chocolate para diabéticos (por encargo)</li>
           <li>vainilla para diabéticos (por encargo)</li>
         </ul>
       </div>
     </li>
     <li> <a class="collapsible-header">Sorbetes<i class="mdi-navigation-arrow-drop-down"></i></a>
       <div class="collapsible-body">
         <ul>
           <li>Frambuesa</li>
           <li>Fresa</li>
           <li>Limón</li>
           <li>Higos (estacional)</li>
           <li>Sandía (estacional)</li>
           <li>Piña</li>
           <li>Mango</li>
           <li>Maracuyá</li>
           <li>Mandarina</li>
           <li>Melón (estacional)</li>
         </ul>
       </div>
     </li>
   </ul>
   <br>
   <h5 class="red-text light">Y además...</h5>
   <ul class="collapsible popout" data-collapsible="accordion">
   <li> <a class="collapsible-header">Repostería<i class="mdi-navigation-arrow-drop-down"></i></a>
       <div class="collapsible-body">
         <ul>
           <li>Brownie</li>
           <li>Marquise de chocolate valrhona</li>
           <li>Macarons</li>
         </ul>
       </div>
     </li>
     <li> <a class="collapsible-header">Bebidas<i class="mdi-navigation-arrow-drop-down"></i></a>
       <div class="collapsible-body">
         <ul>
           <li>Licuados</li>
           <li>Smoothies</li>
           <li>Batidos</li>
           <li>Chocolate caliente</li>
         </ul>
       </div>
     </li>
     <li> <a class="collapsible-header">También<i class="mdi-navigation-arrow-drop-down"></i></a>
       <div class="collapsible-body">
         <ul>
           <li>Creppes</li>
           <li>Gofres</li>
         </ul>
       </div>
     </li>
    </ul>
 </div>
 <div class="row">
 <div class="col s12 l4 center">
 <img class="materialboxed" data-caption="Cucuruchos sin gluten y helados para diabéticos" width="100%" src="img/26.jpg">
 </div>
 <div class="col s12 l4 center">
 <img class="materialboxed" data-caption="Tableta de Brownie" width="100%" src="img/37.jpg">
 </div>
 <div class="col s12 l4 center">
 <img class="materialboxed" data-caption="Brownie" width="100%" src="img/38.jpg">
 </div>
 </div>
 </div>

 <div class="row">
 <div class="col s12 l4 center">
 <img class="materialboxed" data-caption="Gofre con azucar glass" width="100%" src="img/35.jpg">
 </div>
 <div class="col s12 l4 center">
 <img class="materialboxed" data-caption="Macarons" width="100%" src="img/39.jpg">
 </div>
 <div class="col s12 l4 center">
 <img class="materialboxed" data-caption="Marquise de chocolate Valrhona" width="100%" src="img/Producto9.png">
 </div>
 </div>
 </div>

 <div class="row">
 <div class="col s12 l4 center">
 <img class="materialboxed" data-caption="Creppe" width="100%" src="img/Producto5.jpg">
 </div>
 <div class="col s12 l4 center">
 <img class="materialboxed" data-caption="Batido de fresa" width="100%" src="img/Producto10.jpg">
 </div>
 <div class="col s12 l4 center">
 <img class="materialboxed" data-caption="Batido de chocolate" width="100%" src="img/Producto1.jpg">
 </div>
 </div>
 </div> -->

</div>
</div>
</div>
</div>
<!--Products-->

<!--EditProfile-->
<?php if (isset($_SESSION['name'])) { ?>
    <div id="editProfile" class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12 red-text light">Pefil de <?php if (isset($_SESSION['name'])) {
                            echo $_SESSION['name'];
                        } ?></h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="img/background10.png" alt="Localización de la tienda de la calle Vic, Gracia">
        </div>
    </div>

    <div class="container">
        <div class="section">

            <div class="row">
                <div class="col s12 center">
                    <h3><i class=" mdi-action-dashboard brown-text"></i></h3>
                    <h4>Pefil de <?php if (isset($_SESSION['name'])) {

                            if ($_SESSION['id'] == '10207674962976867') {
                                echo "ADMIN";
                            } else {
                                echo $_SESSION["name"];
                            }
                        } else {
                            echo "#UsuarioNoRegistrado";
                        }    ?></h4>
                    <h5 class="red-text light">Esta parte de la web aún está en construcción</h5>
                    <br>
                    <?php if (isset($_SESSION['name'])) { /*var_dump ($_SESSION['datos']);*/
                    } else {
                    } ?>

                </div>
            </div>
        </div>
    </div>
<?php
} else {
} ?>
<!--EditProfile-->

<!--Contact us-->
<div id="contactUs" class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 red-text light">Contáctanos</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="img/contactUsImg.jpg" alt="Unsplashed background img 2"></div>
</div>
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12 center">
                <h3><i class="mdi-content-send brown-text"></i></h3>
                <h4>Contáctanos</h4>
                <h5 class="red-text light">¡TOMO 2 está a tu entera disposición para lo que desees!</h5>

                <p class="left-align light">Envíanos lo que desees decirnos, ya sea una pregunta o cualquier tipo de
                    sugerencia o comentario. </p>
            </div>
        </div>
        <form id="formContactUs" class="col s12 m12 l12" method="post" action="#contactUs">
            <div class="row">
                <div class="input-field col s6 m6 l6">
                    <input id="first_name" type="text">
                    <label for="first_name">Nombre</label>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        <input id="last_name" type="text">
                        <label for="last_name">Apellidos</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12">
                        <input id="email" type="text">
                        <label for="email">E-mail</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l12">
                        <input id="asunto" type="text">
                        <label for="asunto">Asunto</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12">
                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">Comentario</label>
                    </div>
                </div>
                <div class="row center">
                    <button class="waves-effect waves-light btn-large red lighten-1 disabled" type="submit"
                            name="action"><i class="material-icons right">send</i>Enviar
                    </button>
                </div>
                <br>
            </div>
        </form>
    </div>
</div>
<!--Contact us-->

<!--News-->
<div id="news" class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 m12 l12 red-text light">Noticias</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="img/background10.png" alt="Apartado Noticias"></div>
</div>

<div class="container">
    <div class="section">

        <div class="row">
            <div class="col s12 m12 l12 center">
                <h3><i class=" mdi-action-dashboard brown-text"></i></h3>
                <h4>Noticias de TOMO 2</h4>
                <h5 class="red-text light">Esta parte de la web aún está en construcción</h5>
                <br>

                <?php
                //$sql = "SELECT * FROM Noticias WHERE id_noticia = '2'";
                $sql = "SELECT * FROM Noticias";
                $result = mysqli_query($conn, $sql);
                $numRows = mysqli_num_rows($result);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        //if no es el último registro hacer esto // if ($row != $numRows)
                        if ($row["id_news"] % 2 == 0) {
                            ?>
                            <div class="row">


                            <div class="col s4 l4 center">
                                <div class="card">
                                    <div class="card-image"><img src="<?php echo $row["image"]; ?>"
                                                                 alt="<?php echo $row["image"]; ?>" <span
                                            class="card-title"><?php echo $row["name"]; ?></span></div>
                                    <div class="card-content">
                                        <p><?php echo $row["description"]; ?></p>
                                    </div>
                                    <div class="card-action"><a href="<?php echo $row["link"]; ?>" target="_blank">Link
                                            al documento</a></div>
                                </div>
                            </div>

                        <?php
                        } else {
                            ?>

                            <div class="col s4 l4 center">
                                <div class="card">
                                    <div class="card-image"><img src="<?php echo $row["image"]; ?>"
                                                                 alt="<?php echo $row["image"]; ?>" <span
                                            class="card-title"><?php echo $row["name"]; ?></span></div>
                                    <div class="card-content">
                                        <p><?php echo $row["description"]; ?></p>
                                    </div>
                                    <div class="card-action"><a href="<?php echo $row["link"]; ?>" target="_blank">Link
                                            al documento</a></div>
                                </div>
                            </div>

                            </div>

                        <?php
                        }
                        //else (es el último registro) { <div class="row"> <div class="col s6"> <div class="card"> ... </div> </div> </div> }
                        //echo "id: " . $row["id_product"] . " - Name: " . $row["name"] . " - Description: " . $row["description"] . " - Category: " . $row["category"] . " - Subcategory: " . $row["subcategory"] . "<br>";
                    }
                } else {
                    echo "Problemas al obtener las Noticias de la bbdd";
                }

                ?>

            </div>
        </div>
    </div>
</div>
<!--News-->

<!--Footer-->
<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 light red-text">Heladería TOMO 2 situada en Argentería 61</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="img/background5.jpg" alt="Unsplashed background img 3"></div>
</div>
<footer class="page-footer red">
    <div class="container">
        <div class="row">
            <div class="col l6 s6">
                <h5 class="white-text">Teléfonos de contacto</h5>

                <p class="grey-text text-lighten-4">C/Vic Nº 2, Gràcia, Barcelona | 932 173 192</p>

                <p class="grey-text text-lighten-4">C/Argenteria Nº 61, Borne, Barcelona | 933 197 739</p>

                <p class="grey-text text-lighten-4">C/Marià Cubí Nº 156, Sant Gervasi-Sarrià, Barcelona | 932 528
                    973</p>

                <p class="grey-text text-lighten-4">C/Major de Sarrià Nº 75, Sarrià, Barcelona | 932 804 298</p>
            </div>
            <div id="prensa" class="col l2 s2">
                <h5 class="white-text">Prensa</h5>
                <ul id="staggered-list">
                    <li><a class="white-text" href="Prensa/1.pdf">Link 1</a></li>
                    <li><a class="white-text" href="Prensa/2.pdf">Link 2</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text" href="Prensa/3.pdf">Link
                            3</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text" href="Prensa/4.pdf">Link
                            4</a></li>
                    <li><a class="white-text" href="Prensa/5.pdf">Link 5</a></li>
                    <li><a class="white-text" href="Prensa/6.pdf">Link 6</a></li>
                    <li><a class="white-text" href="Prensa/7.pdf">Link 7</a></li>
                    <li><a class="white-text" href="Prensa/8.pdf">Link 8</a></li>
                    <li><a class="white-text" href="Prensa/9.pdf">Link 9</a></li>
                    <li><a class="white-text" href="Prensa/10.pdf">Link 10</a></li>
                    <li><a class="white-text" href="Prensa/11.pdf">Link 11</a></li>
                </ul>
            </div>
            <div class="col l2 s2">
                <h5 class="white-text"></h5>
                <ul class="staggered-list">
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/12.pdf">Link 12</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/13.pdf">Link 13</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/14.pdf">Link 14</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/15.pdf">Link 15</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/16.pdf">Link 16</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/17.pdf">Link 17</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/18.pdf">Link 18</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/19.pdf">Link 19</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/20.pdf">Link 20</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/21.pdf">Link 21</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/22.pdf">Link 22</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/23.pdf">Link 23</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/24.pdf">Link 24</a></li>
                </ul>
            </div>
            <div class="col l2 s2">
                <h5 class="white-text"></h5>
                <ul class="staggered-list">
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/25.pdf">Link 25</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/26.pdf">Link 26</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/27.pdf">Link 27</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/28.jpg">Link 28</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/29.jpg">Link 29</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/30.pdf">Link 30</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/31.jpg">Link 31</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/32.jpg">Link 32</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/33.jpg">Link 33</a></li>
                    <li class style="transform: translateX(0px); opacity: 1;"><a class="white-text"
                                                                                 href="Prensa/34.pdf">Link 34</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container"> TOMO 2 &copy; All Rights Reserved.
            <!--<a class="brown-text text-lighten-3" href="#">Gonxi's</a>-->
            <a href="https://www.facebook.com/Tomodos"><i class="medium material-icons right" style="margin-top: -7px;"><img
                        src="img/socialMediaIcons/48x48/Facebook.png"></i></a>
            <a href="https://twitter.com/tomodoshelados"><i class="medium material-icons right"
                                                            style="margin-top: -7px;"><img
                        src="img/socialMediaIcons/48x48/Twitter.png"></i></a>
            <!--<a href="#"><i class="medium material-icons right" style="margin-top: -7px;"><img src="img/socialMediaIcons/48x48/GooglePlus.png"></i></a> -->
        </div>
    </div>
</footer>
<!--Footer-->

<!--  Scripts -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script src="js/materialize.js"></script>
<script src="js/scrollFire.js"></script>
<script src="js/index.js"></script>
<script src="js/init.js"></script>
<script type="text/javascript" src="../Card-2/fbapp/fb.js"></script>
</body>
</html>