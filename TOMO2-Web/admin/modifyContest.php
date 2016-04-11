<?php session_start();

include_once ('../includes/connection.php');
include_once ('../includes/Contest.php');
include_once ('../includes/tipoRespuesta.php');
include_once ('../PDO/ContestModel.php');
include_once ('../includes/Answer.php');
include_once ('../PDO/AnswerModel.php');

$tipo = new TipoRespuesta();

if (isset($_SESSION['name']) and ($_SESSION['id'] == '10207674962976867')) {

    $id_event = $_GET['id_event'];
    $id_type = $_GET['id_type'];

    $contest = new Contest();
    $contestModel = new ContestModel();

    $answer = new Answer();
    $answerModel = new AnswerModel();


    $tipos = $tipo->fetch_all();

if (isset($_REQUEST['action'])) {

    switch ($_REQUEST['action']) {

        case 'update':

            $contest->__SET('id_event'      , $_REQUEST['id_event']);
            $contest->__SET('name'          , $_REQUEST['name']);
            $contest->__SET('question'      , $_REQUEST['question']);
            $contest->__SET('id_type'       , $_REQUEST['tiposelect']);
            $contest->__SET('initial_date'  , $_REQUEST['initial_date']);
            $contest->__SET('final_date'    , $_REQUEST['final_date']);
            $contest->__SET('winner'        , $_REQUEST['winner']);
            $contest->__SET('active'        , 1);

            $contestModel->Update($contest);

            //echo '<script language="javascript">alert("¡El registro se ha actualizado exitosamente!");</script>';

            echo "<script type=\"text/javascript\">
                alert('¡El registro se ha actualizado exitosamente!');
                history.go(-2);
                </script>";
            break;

        case 'insert':

            if ($_REQUEST['winner'] == ''){
                $_REQUEST['winner'] = 'Sin determinar';
            }

            if ($_REQUEST['tiposelect'] == 2) {

                $contest->__SET('id_event'      , $_REQUEST['id_event']);
                $contest->__SET('id_type'       , $_REQUEST['tiposelect']);
                $contest->__SET('name'          , $_REQUEST['name']);
                $contest->__SET('question'      , $_REQUEST['question']);
                $contest->__SET('initial_date'  , $_REQUEST['initial_date']);
                $contest->__SET('final_date'    , $_REQUEST['final_date']);
                $contest->__SET('winner'        , $_REQUEST['winner']);
                $contest->__SET('active'        , 1);

                $contestModel->Insert($contest);
                $lastID = $answerModel->lastID();

                //$answer->__SET('id_answer'      , $_REQUEST['id_answer']);
                $answer->__SET('id_event'       , $lastID);
                $answer->__SET('respuesta'      , $_REQUEST['first_answer']);
                $answer->__SET('correct'        , $_REQUEST['last_correct']);

                $answerModel->InsertA($answer);

                echo "<script type=\"text/javascript\">
                alert('Se ha añadido correctamente a la base de datos un nuevo Concurso con sus posibles respuestas');
                history.go(-2);
                </script>";
                break;

            } else {

                $contest->__SET('id_event'      , $_REQUEST['id_event']);
                $contest->__SET('id_type'       , $_REQUEST['tiposelect']);
                $contest->__SET('name'          , $_REQUEST['name']);
                $contest->__SET('question'      , $_REQUEST['question']);
                $contest->__SET('initial_date'  , $_REQUEST['initial_date']);
                $contest->__SET('final_date'    , $_REQUEST['final_date']);
                $contest->__SET('winner'        , $_REQUEST['winner']);
                $contest->__SET('active'        , 1);

                $contestModel->Insert($contest);

                echo "<script type=\"text/javascript\">
                alert('Se ha añadido correctamente a la base de datos un nuevo Concurso de tipo texto o imagen');
                history.go(-2);
                </script>";
                break;

            }

            //echo '<script language="javascript">alert("¡Se ha insertado el registro con éxito!");</script>';

        case 'edit':

            $contest = $contestModel->Obtain($_REQUEST['id_event']);
            break;

        default:

            echo "Error with the request action";
            break;

    }
}

?>

    <!doctype html>
    <html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <title> <?php if ($id_event > 0) { echo "Modificar"; } else { echo "Añadir";}?> Concurso</title>
        <link href="../../Card-2/card-2.css" type="text/css" rel="stylesheet">
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">-->
        <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    </head>

<body>
<main class="col l1 m1 s1 center"> <!--id="container"-->
    <h3><?php if ($id_event > 0) { echo "Modificar"; } else { echo "Añadir";}?> Concurso</h3>
    <!--<div class="img-wrapper"> <img src="img/tomo2Inicio.jpg" alt="Just Background"> </div>-->
    <!--<div style="padding-left:38%; padding-top:10px; padding-bottom:10px;">-->

    <?php
    if (isset($error)) { ?>
        <small style="color:#aa0000;"><?php echo $error; ?></small>
        <br /><br />
        <?php
    }
    ?>

    <form action="?action=<?php echo $id_event > 0 ? 'update' : 'insert'; ?>" method="post">
        <input type="hidden" name="id_event" value="<?php echo $contest->__GET('id_event'); ?>"/>
        <input type="text" name="name" value="<?php echo $contest->__GET('name'); ?>" placeholder="Nombre"/>
        <input type="text" name="question" value="<?php echo $contest->__GET('question'); ?>" placeholder="Pregunta"/>
        <!--<input type="text" name="id_type" value="<?php //echo $contest->__GET('id_type'); ?>" placeholder="Tipo de respuesta"/> -->
        <select class="browser-default" id="tiposelect" name="tiposelect" onchange="ShowSelected();">
            <option disabled selected>Tipo de respuesta</option>
            <option value="0">Texto</option>
            <option value="1">Imagen</option>
            <option value="2">Multiopción</option>
        </select>


            <div id="input1" style="margin-bottom:4px;" class="clonedInput col s6">
                <input class="input_fa" type="text" name="first_answer" id="first_answer" placeholder="Respuesta" value="<?php echo $answer->__GET('respuesta'); ?>" disabled hidden/>
                <input class="input_lc" type="text" name="last_correct" id="last_correct" placeholder="Correcta = 1 / Incorrecta = 0" value="<?php echo $answer->__GET('correct'); ?>" disabled hidden>
<!--                <input class="input_lc" type="radio" name="last_correct" id="last_correct" placeholder="Correcta = 1 / Incorrecta = 0" value="--><?php //echo $answer->__GET('correct'); ?><!--" disabled hidden>-->
<!--                <label for="last_correct" hidden>¿Respuesta correcta?</label>-->
            </div>


        <input type="button" name="addAnswer" id="btnAdd" value="Añadir respuesta" disabled hidden> <input type="button" name="delAnswer" id="btnDel" value="Eliminar respuesta" disabled hidden>

<!--            <input class="input-field col" name="id_answer" type="hidden" hidden>-->
<!--            <input class="input-field col s6" name="respuesta" hidden>-->
            <!--<input class="input-field col s6" name="correct" hidden>-->
            <!--<input name="correct" type="radio" id="correct" hidden/>-->



        <input type="date" name="initial_date" value="<?php echo $contest->__GET('initial_date'); ?>" placeholder="Día inicial"/>
        <input type="date" name="final_date" value="<?php echo $contest->__GET('final_date'); ?>" placeholder="Día final"/>
        <input type="hidden" name="winner" value="<?php echo $contest->__GET('winner'); ?>" placeholder="Ganador - Por defecto Sin determinar"/>
        <input type="hidden" name="active" value="<?php echo $contest->__GET('active'); ?>" placeholder="Activo (0 = false, 1 = true)"/>
        <input type="submit" name="guardar" value="guardar">
        <!--<button type="submit">Save</button>-->
    </form>
    <br/>


    <script type="text/javascript">
        function ShowSelected()
        {
            /* Para obtener el valor */
            var cod = document.getElementById("tiposelect").value;
            //alert(cod);

            switch(document.forms[0].tiposelect.selectedIndex){
                case 0:
                    document.forms[0].first_answer.disabled=true;
                    document.forms[0].last_correct.disabled=true;
                    document.forms[0].addAnswer.disabled=true;
                    document.forms[0].delAnswer.disabled=true;

                    document.forms[0].first_answer.hidden=true;
                    document.forms[0].last_correct.hidden=true;
                    document.forms[0].addAnswer.hidden=true;
                    document.forms[0].delAnswer.hidden=true;
                    break;

                case 1:
                    document.forms[0].first_answer.disabled=true;
                    document.forms[0].last_correct.disabled=true;
                    document.forms[0].addAnswer.disabled=true;
                    document.forms[0].delAnswer.disabled=true;

                    document.forms[0].first_answer.hidden=true;
                    document.forms[0].last_correct.hidden=true;
                    document.forms[0].addAnswer.hidden=true;
                    document.forms[0].delAnswer.hidden=true;
                    break;

                case 2:
                    document.forms[0].first_answer.disabled=true;
                    document.forms[0].last_correct.disabled=true;
                    document.forms[0].addAnswer.disabled=true;
                    document.forms[0].delAnswer.disabled=true;

                    document.forms[0].first_answer.hidden=true;
                    document.forms[0].last_correct.hidden=true;
                    document.forms[0].addAnswer.hidden=true;
                    document.forms[0].delAnswer.hidden=true;
                    break;

                case 3:
                    document.forms[0].first_answer.disabled=false;
                    document.forms[0].last_correct.disabled=false;
                    document.forms[0].addAnswer.disabled=false;
                    document.forms[0].delAnswer.disabled=false;

                    document.forms[0].first_answer.hidden=false;
                    document.forms[0].last_correct.hidden=false;
                    document.forms[0].addAnswer.hidden=false;
                    document.forms[0].delAnswer.hidden=false;
                    break;
            }

        }
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#btnAdd').click(function() {
                    var num     = $('.clonedInput').length;
                    var newNum  = new Number(num + 1);
                    var newElem = $('#input' + num).clone().attr('id', 'input' + newNum).fadeIn('slow');

                    // First name - text
                    newElem.find('.input_fa').attr('id', 'ID' + newNum + '_first_answer').attr('name', 'ID' + newNum + '_first_answer').val('');

                    // Last name - text
                    newElem.find('.input_lc').attr('id', 'ID' + newNum + '_last_correct').attr('name', 'ID' + newNum + '_last_correct').val('');

                    // Insert the new element after the last "duplicatable" input field
                    $('#input' + num).after(newElem);
                    $('#ID' + newNum + '_tiposelect').focus();

                    $('#btnDel').attr('disabled','');

                    if (newNum == 20)
                        $('#btnAdd').attr('disabled','disabled');
                });

                $('#btnDel').click(function() {
                    var num = $('.clonedInput').length;

                    $('#input' + num).remove();
                    $('#btnAdd').attr('disabled','');

                    if (num-1 == 1)
                        $('#btnDel').attr('disabled','disabled');
                });

                $('#btnDel').attr('disabled','disabled');
            });
    </script>


    <?php
} else {
    echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
    exit;
}
?>