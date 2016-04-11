<?php

require_once '../includes/connection.php';

$id_event = $_GET['id_event'];
$active = $_GET['active'];
?>

<html>
<head>
    <title>Testeo</title>
    <meta charset="UTF-8">
</head>
<body>

<form action="statusContest.php?id_event=<?php $id_event?>" method="post">

    <p>
        <input type="checkbox" name="check" id="check" <?php if ($active == 1){ echo "checked"; } else { echo ""; } ?>/>
        <label for="check">Active</label>
    </p>

</form>

<?php

if ($active == 1){
    echo "checkbox activado";

    $doneQuery = $pdo->prepare("
                        UPDATE concursos
                        SET active = 0
                        WHERE id_event = :id_event
                        ");

    $doneQuery->execute(['id_event' => $id_event]);

    echo "<script type=\"text/javascript\">
           alert('El valor del campo activo se ha actualizado correctamente a 0');
           history.go(-1);
       </script>";
    exit;

} elseif ($active == 0) {
    echo "checkbox no activado";

    $doneQuery = $pdo->prepare("
                        UPDATE concursos
                        SET active = 1
                        WHERE id_event = :id_event
                        ");

    $doneQuery->execute(['id_event' => $id_event]);

    echo "<script type=\"text/javascript\">
           alert('El valor del campo activo se ha actualizado correctamente a 1');
           history.go(-1);
       </script>";
    exit;

} else {
    exit("Error al identificar el producto");
}

?>


</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

<script>

    $("#check").on('change', function () {
        if ($(this).is(':checked')) {
            // Hacer algo si el checkbox ha sido seleccionado
            //alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");

        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            //alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");

        }
    });

</script>
</html>