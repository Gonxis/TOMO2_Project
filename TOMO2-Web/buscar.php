<?php
//cadena de conexion 
$conn = mysqli_connect("localhost", "root", "root", "TOMO2");
//DEBO PREPARAR LOS TEXTOS QUE VOY A BUSCAR si la cadena existe 
if ($busqueda <> '') {
//CUENTA EL NUMERO DE PALABRAS
    $trozos = explode(" ", $busqueda);
    $numero = count($trozos);
    if ($numero == 1) {
        //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE
        $cadbusca = "SELECT subcategory, name FROM Productos WHERE subcategory LIKE '%$busqueda%' OR name LIKE '%$busqueda%' LIMIT 50";
    } elseif ($numero > 1) {
        //SI HAY UNA FRASE SE UTILIZA EL ALGORTIMO DE BUSQUEDA AVANZADO DE MATCH AGAINST
        //busqueda de frases con mas de una palabra y un algoritmo especializado
        $cadbusca = "SELECT subcategory, name , MATCH ( name, subcategory ) AGAINST ( '$busqueda' ) AS Score FROM Productos WHERE MATCH ( name, subcategory ) AGAINST ( '$busqueda' ) ORDER BY Score DESC LIMIT 50";
    }
    $result = mysqli($conn, $cadbusca);
    While ($row = mysqli_fetch_object($result)) {
        //Mostramos los titulos de los articulos o lo que deseemos...
        $subcategory = $row->subcategory;
        $name = $row->name;
        echo $subcategory . " - " . $name . "<br>";;
    }
}
?>
