<?php

    include('../../php/conexion.php');

    //Iniciar Sesión
    session_start();
    mysqli_set_charset($conexion,'UTF-8');

    //Validar si se está ingresando con sesión un usuario con permisos
    $permiso = intval($_SESSION['permiso']);
    if (!isset($_SESSION) || !$_SESSION){
        header("Location: /institutoInguz");
        die;
    }

    ## // OBTENER LA FECHA DEL DIA ACTUAL
    $hoy = getdate();
    $hoy = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $esp = $_POST['especialidad'];
        $grupo = intval($_POST['num_grup']);
        $horario = $_POST['horario'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $profesor = $_POST['profesor'];
        $materia = $_POST['nivel'];
        $inscritos = 0;

        $prodserv = 5003;

        if($horario == '' || $profesor == '' || $materia == ''){
            echo "<script language = javascript>
            alert('Ocurrio un error al intentar registrar el grupo, intentar mas tarde.');
            window.location='list.php';
            </script>";
            die ("Error al realizar los registros correspondientes " . $e->getMessage());
        } else {
            /*echo $grupo . '<br>';
            echo $esp . '<br>';
            echo $materia . '<br>';
            echo $hoy . '<br>';
            echo $fecha_inicio . '<br>';
            echo $fecha_fin . '<br>';
            echo $horario . '<br>';
            echo $profesor . '<br>';
            echo $inscritos . '<br>' ;*/

            $query = $conexion->prepare(
                "INSERT INTO tbgrupo
                (idgrupo, especialidad, materia, fechalta, fechainicio, fechafin,
                horario, profesor, inscritos, prodserv)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            ) or die("Error al registrar al grupo " . mysqli_error($conexion));

            $query->bind_param("iiisssiiii", $grupo, $esp, $materia, $hoy, $fecha_inicio, $fecha_fin, $horario, $profesor, $inscritos, $prodserv);

            $query->execute();

            echo "<script language = javascript>
            alert('Grupo registrado.');
            window.location='list.php';
            </script>";
        }

        #var_dump($_POST);
    }




    ## // OBTENER TODAS LAS ESPECIALIDADES
    $especialidades = $conexion->query(
        "SELECT * FROM catespecialidad"
    ) or die(" Error al obetener las especialidades " . mysqli_error($conexion));

    ## // OBTENER EL NUMERO DE GRUPO SIGUIENTE
    $grupos = $conexion->query(
        "SELECT * FROM tbgrupo
        ORDER BY idgrupo DESC"
    ) or die ("Error al obtener los grupos " . mysqli_error($conexion));

    if($grupos->num_rows > 0){
        $ultimoG = $grupos->fetch_assoc();
        $siguiente = $ultimoG['idgrupo'] + 1;
    } else {
        $siguiente = 1;
    }


    $titulo = 'Registro Grupo';
    require '../../plantillas/nav_side.view.php';
?>

<div class="cont">
    <h1 class="title">Registrar nuevo grupo</h1>

    <!-- INICIAMOS CONTENEDOR PARA LA TABLA DEL FORMULARIO -->
    <div class="main-container">
        <form action="form_grupo.php" method="post">
          <div class="tabla-scroll-container-ver">
            <table class="tabla-consulta-modal-form">

                <!-- IMPORTANTE
                     INGRESAR A LA BASE DE DATOS AUTOMATICO VARIAS FECHAS
                -->
                <!-- INFORMACION DEL GRUPO -->
                <tr>
                    <th colspan="4" style="border-bottom: 1px solid grey; border-top: 1px solid grey; background: rgb(179, 200, 228);">Grupo</th>
                </tr>
                <tr>
                    <th>
                        <label for="fecha" class="label">Fecha de hoy:</label>
                    </th>
                    <td>
                        <!-- Muestra la fecha del dia actual -->
                        <input type="text" name="fecha" class="input" value="<?php echo $hoy; ?>" id="fecha" title="Fecha de hoy" readonly>
                    </td>
                    <th>
                        <label for="especialidad" class="label">Especialidad:</label>
                    </th>
                    <td>
                        <select name="especialidad" id="especialidad" class="select" title="Seleccione especialidad">
                            <option value="0">-- Seleccione especialidad --</option>
                            <?php
                                while($esp = $especialidades->fetch_assoc()){
                            ?>
                                <option value="<?php echo $esp['idespecialidad']; ?>"><?php echo $esp['nombre'] ?></option>
                            <?php 
                                }
                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="num_grupo" class="label">No. Grupo:</label>
                    </th>
                    <td>
                        <!-- Generar automatico el numero de grupo -->
                        <input type="number" name="num_grup" class="input" value="000<?php echo $siguiente; ?>" id="num_grupo" title="Numero de grupo" readonly>
                    </td>
                    <th>
                        <label for="horario" class="label">Horario:</label>
                    </th>
                    <td id="horarios">
                        <!--<select name="horario" id="horario" class="select" title="Seleccionar horario">
                            <option value="matutino">Matutino</option>
                            <option value="vespertino">Vespertino</option>
                        </select>-->
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="fecha_inicio" class="label">Inicio de curso:</label>
                    </th>
                    <td>
                        <input type="date" name="fecha_inicio" class="input" id="fecha_inicio" title="Ingrese fecha de inicio" required>
                    </td>
                    <th>
                        <label for="fecha_fin" class="label">Final de curso:</label>
                    </th>
                    <td>
                        <input type="date" name="fecha_fin" class="input" id="fecha_fin" title="Ingrese fecha de fin" required>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="profesor" class="label">Profesor:</label>
                    </th>
                    <td id="profesores">
                        <!--<select name="profesor" id="profesor" class="select" title="Seleccionar el profesor">
                            <option value="Juan Carreon">Juan Carreon</option>
                            <option value="Beatriz Diaz">Beatriz Diaz</option>
                        </select>-->
                    </td>
                    <th>
                        <label for="nivel" class="label">Nivel / Modalidad:</label>
                    </th>
                    <td id="materias">
                        <!--<select name="nivel" id="nivel" class="select" title="Seleccionar el nivel del grupo">
                            <option value="primero">Primero</option>
                            <option value="segundo">Segundo</option>
                            <option n value="tercero">Tercero</option>
                        </select>-->
                    </td>
                </tr>
            </table>
          </div>
          <input type="submit" value="Registrar grupo" class="submit">
        </form>
    </div>
</div>

<script>
    // Ajax para buscar colaboradoreres
    $(BuscaHorario()); // Ejecutar automaticamente la funcion
    $(BuscaProfs());
    $(BuscaMats());


    // |
    // |    Buscar los horarios registrados para la especialidad seleccionada
    // |
    function BuscaHorario(esp){
        $.ajax({
            url: 'buscaHorario.php',
            type: 'POST',
            dataType: 'html',
            data: {
                esp: esp
            },
        })
        .done(function(respuesta){
            $("#horarios").html(respuesta);
        })
        .fail(function(){
            console.log(error);
        })
    }

    // Se ejecuta hasta que el usuario escribe
    $("#especialidad").change(function(){
        var esp = $("#especialidad").val();

        console.log ('Esp: ' + esp);

        BuscaHorario(esp);
    })

    // |
    // |    Buscar los profesores registrados para la especialidad seleccionada
    // |

    function BuscaProfs(esp){
        $.ajax({
            url: 'buscaProfs.php',
            type: 'POST',
            dataType: 'html',
            data: {
                esp: esp
            },
        })
        .done(function(respuesta){
            $("#profesores").html(respuesta);
        })
        .fail(function(){
            console.log(error);
        })
    }

    // Se ejecuta hasta que el usuario escribe
    $("#especialidad").change(function(){
        var esp = $("#especialidad").val();

        console.log ('Esp: ' + esp);

        BuscaProfs(esp);
    })

        // Se ejecuta hasta que el usuario escribe
        $("#especialidad").change(function(){
        var esp = $("#especialidad").val();

        console.log ('Esp: ' + esp);

        BuscaHorario(esp);
    })

    // |
    // |    Buscar las materias registradas para la especialidad seleccionada
    // |
    function BuscaMats(esp){
        $.ajax({
            url: 'buscaMats.php',
            type: 'POST',
            dataType: 'html',
            data: {
                esp: esp
            },
        })
        .done(function(respuesta){
            $("#materias").html(respuesta);
        })
        .fail(function(){
            console.log(error);
        })
    }

    // Se ejecuta hasta que el usuario escribe
    $("#especialidad").change(function(){
        var esp = $("#especialidad").val();

        console.log ('Esp: ' + esp);

        BuscaMats(esp);
    })


</script>