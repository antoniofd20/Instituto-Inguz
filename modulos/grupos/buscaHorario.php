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

    $salida = '';

    ## // LISTAR A TODOS LOS COLABORADORES SI NO SE HA INGRESADO BUSQUEDA
    $esp = 0;
    $horarios = $conexion->query(
        "SELECT * FROM cathorario h
        JOIN catespecialidad e ON (h.especialidad = e.idespecialidad)
        WHERE especialidad = '$esp'"
    ) or die("Error al obtener los horarios " . mysqli_error($conexion));

    ## // EN CASO DE RECIBIR NOMBRE DE BUSQUEDA SE EJECUTA 
    if(isset($_POST['esp'])){
        $esp = $_POST['esp'];

        $horarios = $conexion->query(
            "SELECT * FROM cathorario h
            JOIN catespecialidad e ON (h.especialidad = e.idespecialidad)
            WHERE especialidad = '$esp'"
        )or die("Error al obtener los horarios " . mysqli_error($conexion));
    }

    #var_dump($horarios->num_rows);
    
    #var_dump($qcolabs->num_rows)

    if($horarios->num_rows > 0){
        $salida .= '
            <select name="horario" id="horario" class="select" title="Seleccionar horario" required>
        ';

        while($horario = $horarios->fetch_assoc()){
            $salida .= '
                    <option value="' . $horario['idhorario'] . '">'. $horario['dias'] . ' de ' . $horario['horainicio'] . ' a ' . $horario['horafin'] .'</option>
            ';
        }
        $salida .= '
            </select>
        ';
    } else {
        $salida .= '
            <p style="color:red">No hay horarios para la especialidad</p>
        ';
    }

    echo $salida;
    $conexion->close();

